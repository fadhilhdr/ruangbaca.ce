<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookLoan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode_unik_buku', 
        'user_id', 
        'loan_date', 
        'due_date', 
        'return_date',
        'renewal_count', 
    ];

    protected $dates = [
        'loan_date',
        'due_date',
        'return_date',
        'created_at',
        'updated_at'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'kode_unik_buku', 'kode_unik');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'userid');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'book_loan_id');
    }

    public function lostBook()
    {
        return $this->hasOne(LostBook::class, 'book_loan_id');
    }

    public function hasActiveLostBook()
    {
        return $this->lostBook()
            ->whereIn('replacement_status', ['awaiting_verif', 'decline'])
            ->exists();
    }

    //UNTUK VALIDASI TERKAIT LOANS
    public function canRenew()
    {
    return $this->renewal_count < 1 
        && Carbon::parse($this->due_date)->greaterThanOrEqualTo(now())
        && is_null($this->return_date);
    }

    public function canReturn()
    {
        return $this->return_date === null;
    }

    public function isLate()
    {
        return Carbon::now()->greaterThan($this->due_date) && is_null($this->return_date);
    }
    
    public function hasPaidFine()
    {
        return $this->transactions()->where('transaction_type_id', 4)->exists();
    }
    public function isReturned()
    {
        return $this->transactions()->where('transaction_type_id', 3)->exists();
    }
}


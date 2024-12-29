<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookLoan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'book_id', 
        'user_id', 
        'loan_date', 
        'due_date', 
        'return_date',
        'renewal_count', 
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'userid');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'book_loan_id');
    }

    public function lostBooks()
    {
        return $this->hasMany(LostBook::class, 'book_loan_id');
    }

    //UNTUK VALIDASI TERKAIT LOANS
    public function canRenew()
    {
        return $this->renewal_count < 1 && $this->due_date >= now();
    }

    public function canReturn()
    {
        return $this->return_date === null && $this->due_date >= now();
    }

}


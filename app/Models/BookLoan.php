<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookLoan extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'user_id', 'loan_date', 'due_date', 'return_date', 'renewal_count', 'fine_amount', 'loan_status'];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function lostBook()
    {
        return $this->hasOne(LostBook::class);
    }
}


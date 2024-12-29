<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_loan_id', 
        'book_id', 
        'user_id', 
        'date_reported', 
        'replacement_status'
    ];

    public function bookLoan()
    {
        return $this->belongsTo(BookLoan::class, 'book_loan_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'userid');
    }
}

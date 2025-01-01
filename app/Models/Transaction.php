<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_loan_id', 
        'transaction_type_id', 
    ];

    public function bookLoan()
    {
        return $this->belongsTo(BookLoan::class, 'book_loan_id');
    }

    public function type()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }

    public function fines()
    {
        return $this->hasMany(Fine::class);
    }
}


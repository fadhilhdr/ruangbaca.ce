<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['book_loan_id', 'transaction_type', 'amount'];

    public function bookLoan()
    {
        return $this->belongsTo(BookLoan::class);
    }
}


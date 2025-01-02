<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $fillable = [
        'transaction_id',
        'book_loan_id',
        'amount',
        'status',
        'bukti_tf',
        'paid_at',
        'verified_at',
    ];

    public function transaction_types()
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function bookLoan()
    {
        return $this->belongsTo(BookLoan::class);
    }
}


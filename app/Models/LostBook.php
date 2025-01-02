<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_loan_id',
        'date_reported',
        'replacement_status',
    ];

    // Relasi ke tabel BookLoan
    public function bookLoan()
    {
        return $this->belongsTo(BookLoan::class, 'book_loan_id');
    }

    // Relasi ke tabel User melalui BookLoan
    public function user()
    {
        return $this->bookLoan->user();
    }

    // Mengakses ISBN melalui relasi ke BookLoan dan Book
    public function getIsbnAttribute()
    {
        return $this->bookLoan->book->isbn ?? null; // Mendapatkan ISBN dari tabel books
    }
}


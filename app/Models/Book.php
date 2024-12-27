<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['isbn', 'title', 'author', 'stock', 'thumbnail', 'specialization_id'];

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function bookLoans()
    {
        return $this->hasMany(BookLoan::class);
    }

    public function lostBooks()
    {
        return $this->hasMany(LostBook::class);
    }
}

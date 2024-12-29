<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'isbn', 
        'title', 
        'author', 
        'total_stock', 
        'available_stock',
        'thumbnail', 
        'specialization_id', 
        'synopsis'
    ];

    public function specialization()
    {
        return $this->belongsTo(Specialization::class, 'specialization_id');
    }

    public function loans()
    {
        return $this->hasMany(BookLoan::class, 'book_id');
    }

    public function lostBooks()
    {
        return $this->hasMany(LostBook::class, 'book_id');
    }

    //untuk otomatis update available stock
    public function updateStock()
    {
        $this->available_stock = $this->total_stock - $this->loans()->whereNull('return_date')->count();
        $this->save();
    }
    
}

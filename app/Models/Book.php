<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul', 
        'penulis',
        'penerbit', 
        'isbn', 
        'peminatan', 
        'sub_peminatan',
        'kode_unik',
        'thumbnail',  
        'synopsis',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
    ];

    public function loans()
    {
        return $this->hasMany(BookLoan::class, 'kode_unik_buku', 'kode_unik');
    }

    public function lostBooks()
    {
        return $this->hasMany(LostBook::class, 'kode_unik_buku');
    }
}

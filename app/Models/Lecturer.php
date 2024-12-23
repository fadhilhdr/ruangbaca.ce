<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    protected $primaryKey = 'nip';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'nip', 
        'name', 
        'kode_dosen', 
        'riwayat_s1', 
        'riwayat_s2', 
        'riwayat_s3', 
        'kepakaran1', 
        'kepakaran2'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nip', 'userid'); 
    }

}

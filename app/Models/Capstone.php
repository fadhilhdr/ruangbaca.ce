<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capstone extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_kelompok',
        'anggota1_nim',
        'anggota2_nim',
        'anggota3_nim',
        'kategori',
        'judul_capstone',
        'c100_path',
        'c200_path',
        'c300_path',
        'c400_path',
        'c500_path',
    ];

    public function anggota1()
    {
        return $this->belongsTo(Student::class, 'anggota1_nim', 'nim');
    }

    public function anggota2()
    {
        return $this->belongsTo(Student::class, 'anggota2_nim', 'nim');
    }

    public function anggota3()
    {
        return $this->belongsTo(Student::class, 'anggota3_nim', 'nim');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nim_nip_nppu_nupk',
        'name',
        'instansi',
        'tanggal',
        'check_in_at',
        'check_out_at'
    ];    
}
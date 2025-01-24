<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'nim';
    protected $keyType    = 'string';
    public $incrementing  = false;

    protected $fillable = [
        'nim',
        'name',
        'angkatan',
        'gender',
        'status_terakhir',
        'jalur_masuk',
        'prodi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nim', 'userid');
    }

}

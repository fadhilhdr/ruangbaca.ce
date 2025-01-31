<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table      = 'pegawais';
    protected $primaryKey = 'nip_nppu_nupk';
    public $incrementing  = false;
    protected $keyType    = 'int';

    protected $fillable = [
        'id',
        'nama_lengkap',
        'nip_nppu_nupk',
        'nidn_nidk_nup_nitk',
        'nuptk',
        'pangkat_golongan',
        'jabatan_fungsional',
        'tugas_tambahan_1',
        'tugas_tambahan_2',
        'tugas_tambahan_3',
        'tugas_tambahan_4',
        'kepakaran',
        'pendidikan_terakhir',
        'jurusan',
        'status_bekerja',
        'status_kepegawaian',
        'jenis_pegawai',
        'unit_kerja',
        'bagian',
        'subbagian',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nip_nppu_nupk', 'userid');
    }
}
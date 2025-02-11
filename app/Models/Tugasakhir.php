<?php
namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Tugasakhir extends Model
{
    use HasFactory;

    protected $table = 'tugasakhirs';

    protected $fillable = [
        'nim',
        'title',
        'full_document',
        'cover_abstract',
        'bab1_pendahuluan',
        'bab2_kajianpustaka',
        'bab3_perancangan',
        'bab4_hasilpembahasan',
        'bab5_penutup',
        'lampiran',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'nim', 'userid');
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('title', 'LIKE', "%{$keyword}%");
    }

    public function getDocumentUrl($file)
    {
        return $this->$file ? Storage::url($this->$file) : null;
    }

    public function isFileAvailable()
    {
        return ! empty($this->full_document);
    }
}

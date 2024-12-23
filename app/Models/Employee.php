<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $primaryKey = 'nip';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['nip', 'name', 'division'];

    public function user()
    {
        return $this->belongsTo(User::class, 'nip', 'userid'); 
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = ['nim', 'name', 'check_in_at', 'check_out_at'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'nim', 'nim');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'userid', 'nim');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = ['userid', 'name', 'instansi', 'check_in_at', 'check_out_at'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'userid', 'nim');
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'userid', 'nip');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'userid', 'nip');
    }
}
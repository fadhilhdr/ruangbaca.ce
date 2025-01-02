<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'userid';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'userid', 
        'name',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'nim', 'userid'); // userid sebagai referensi nim
    }

    public function lecturer()
    {
        return $this->hasOne(Lecturer::class, 'nip', 'userid'); // userid sebagai referensi nip
    }

    public function employee()
    {
        return $this->hasOne(Employee::class, 'nip', 'userid'); // userid sebagai referensi nip
    }

    public function getTypeAttribute()
    {
        if ($this->student) {
            return 'student';
        }
        if ($this->lecturer) {
            return 'lecturer';
        }
        if ($this->employee) {
            return 'employee';
        }
        return null;
    }

    // VALIDASI
    public function activeLoans()
    {
        return $this->hasMany(BookLoan::class)->whereNull('return_date');
    }
}

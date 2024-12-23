<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Set userid sebagai primary key
    protected $primaryKey = 'userid';
    protected $keyType = 'string';
    public $incrementing = false;

    // Mass assignment attributes
    protected $fillable = [
        'userid', // Tambahkan userid agar dapat diisi langsung
        'name',
        'password',
        'role_id',
    ];

    // Hidden attributes
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Casting attributes
    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * Relasi ke tabel roles
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relasi ke tabel students
     */
    public function student()
    {
        return $this->hasOne(Student::class, 'nim', 'userid'); // userid sebagai referensi nim
    }

    /**
     * Relasi ke tabel lecturers
     */
    public function lecturer()
    {
        return $this->hasOne(Lecturer::class, 'nip', 'userid'); // userid sebagai referensi nip
    }

    /**
     * Relasi ke tabel employees
     */
    public function employee()
    {
        return $this->hasOne(Employee::class, 'nip', 'userid'); // userid sebagai referensi nip
    }

    /**
     * Metode untuk menentukan tipe user berdasarkan relasi
     */
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
}

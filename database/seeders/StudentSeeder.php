<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run()
    {
        Student::insert([
            [
                'nim' => '21120121120023',
                'name' => 'MUHAMAD IBNU FADHIL',
                'angkatan' => '2021',
                'gender' => 'PRIA',
                'status_terakhir' => '[2024-1] Aktif',
                'prodi' => 'Teknik Komputer S1',
                'jalur_masuk' => 'SNMPTN',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '21120121130120',
                'name' => 'FADHIL HADRIAN AZZAMI',
                'angkatan' => '2021',
                'gender' => 'PRIA',
                'status_terakhir' => '[2024-2] Aktif',
                'prodi' => 'Teknik Komputer S1',
                'jalur_masuk' => 'SBMPTN',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '21120121140131',
                'name' => 'FADHILLAH ZAINUM MUTTAQIN',
                'angkatan' => '2021',
                'gender' => 'PRIA',
                'status_terakhir' => '[2024-1] Aktif',
                'prodi' => 'Teknik Komputer S1',
                'jalur_masuk' => 'UM S1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nim' => '21120121140033',
                'name' => 'Fikri Abdurrohim Ibnu Prabowo',
                'angkatan' => '2021',
                'gender' => 'PRIA',
                'status_terakhir' => '[2024-1] Aktif',
                'prodi' => 'Teknik Komputer S1',
                'jalur_masuk' => 'UM S1',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}

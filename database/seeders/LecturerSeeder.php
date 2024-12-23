<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lecturers')->insert([
            [
                'nip' => '197302261998021001',
                'name' => 'Dr. Adian Fatchur Rochim, ST, MT, SMIEEE',
                'kode_dosen' => '2965',
                'riwayat_s1' => 'Universitas Diponegoro',
                'riwayat_s2' => 'Institut Teknologi Bandung',
                'riwayat_s3' => 'Universitas Indonesia',
                'kepakaran1' => 'Jaringan Komputer',
                'kepakaran2' => 'IT-Governance',
            ],
            [
                'nip' => '197706152008011011',
                'name' => 'Rinta Kridalukmana, S.Kom, MT., PhD',
                'kode_dosen' => '2965',
                'riwayat_s1' => 'Universitas Stikubank',
                'riwayat_s2' => 'Institut Teknologi Bandung',
                'riwayat_s3' => 'University Technology of Sidney',
                'kepakaran1' => 'Sistem Informasi',
                'kepakaran2' => 'Software Engineering',
            ],
            [
                'nip' => '197007272000121001',
                'name' => 'Dr. R. Rizal Isnanto, ST, MM, MT',
                'kode_dosen' => '2965',
                'riwayat_s1' => 'Universitas Gadjah Mada',
                'riwayat_s2' => 'Universitas Gadjah Mada',
                'riwayat_s3' => 'Universitas Gadjah Mada',
                'kepakaran1' => 'Pengolahan Citra Digital',
                'kepakaran2' => 'Pengenalan Pola',
            ],
            [
                'nip' => '197106061995121003',
                'name' => 'Agung Budi Prasetijo, ST, MIT, Ph.D',
                'kode_dosen' => '2951',
                'riwayat_s1' => 'Universitas Diponegoro',
                'riwayat_s2' => 'Queensland University of Technology',
                'riwayat_s3' => 'King Saud University',
                'kepakaran1' => 'Jaringan Komputer Ad-hoc & Infrastructure',
                'kepakaran2' => 'Artificial Intelligence',
            ],
        ]);
    }
}

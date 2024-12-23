<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    public function run()
    {
        DB::table('students')->insert([
            ['nim' => '21120121110038', 'name' => 'MUHAMMAD FAQIH IMAADUDDIN', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120001', 'name' => 'MUHAMAD FATKHUL YAKARIA', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120002', 'name' => 'RAFLY AN NINDRA FITRAH PRATAMA', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120003', 'name' => 'YOSUA EVAN YUDHA', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120004', 'name' => 'DIDID BAYU FARIZQI', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120005', 'name' => 'VANE KARENINA THETAN HARTONO', 'angkatan' => '2021', 'gender' => 'WANITA', 'status' => 'AKTIF'],
            ['nim' => '21120121120006', 'name' => 'BAGUS WIJANARKO', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120007', 'name' => 'SITI ISYAROH', 'angkatan' => '2021', 'gender' => 'WANITA', 'status' => 'AKTIF'],
            ['nim' => '21120121120008', 'name' => 'HILMY DHIYA ULHAQ', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120009', 'name' => 'DESTIANA AYU ANGGRAINI', 'angkatan' => '2021', 'gender' => 'WANITA', 'status' => 'AKTIF'],
            ['nim' => '21120121120010', 'name' => 'KUMALA DEWI KUSUMAWATI', 'angkatan' => '2021', 'gender' => 'WANITA', 'status' => 'AKTIF'],
            ['nim' => '21120121120011', 'name' => 'DISTI DIAHNING AYUWANGI', 'angkatan' => '2021', 'gender' => 'WANITA', 'status' => 'AKTIF'],
            ['nim' => '21120121120012', 'name' => 'RAFIQ BAGUS FIRNANDA', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120013', 'name' => 'VINCENT GREGORY GINTING', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120014', 'name' => 'MUHAMMAD HAIKAL AFINAS SIDIQ', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120015', 'name' => 'DHEA RAHMADANIA PUTRI CHANAFI', 'angkatan' => '2021', 'gender' => 'WANITA', 'status' => 'AKTIF'],
            ['nim' => '21120121120016', 'name' => 'DIMAS FAJAR AWALUDIN', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120017', 'name' => 'DHEA ANANDITA PUTRI', 'angkatan' => '2021', 'gender' => 'WANITA', 'status' => 'AKTIF'],
            ['nim' => '21120121120018', 'name' => 'MUHAMMAD ZAMROL IMADA', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120019', 'name' => 'RATSTSAN NUR AKMAL ADIWIJAYA', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120020', 'name' => 'NIKOLAUS EVAN DEWANTO', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120021', 'name' => 'DESY MONICA ZAHARANI', 'angkatan' => '2021', 'gender' => 'WANITA', 'status' => 'AKTIF'],
            ['nim' => '21120121120022', 'name' => 'FERI SYAHRUL ARIFIN', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120023', 'name' => 'MUHAMAD IBNU FADHIL', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120024', 'name' => 'FATHIN ZHAFIRA FAUZI', 'angkatan' => '2021', 'gender' => 'WANITA', 'status' => 'AKTIF'],
            ['nim' => '21120121120025', 'name' => 'PIPIN DIEN LUXVIANA', 'angkatan' => '2021', 'gender' => 'WANITA', 'status' => 'AKTIF'],
            ['nim' => '21120121120026', 'name' => 'NICHOLAS PRIYAMBODO ADI', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120027', 'name' => 'LINA SILFIYAH', 'angkatan' => '2021', 'gender' => 'WANITA', 'status' => 'AKTIF'],
            ['nim' => '21120121120028', 'name' => 'FAUZAN RAMADHAN', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120029', 'name' => 'YOSIA ASER CAMME', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            ['nim' => '21120121120030', 'name' => 'DYZA KHOIRUN NISA', 'angkatan' => '2021', 'gender' => 'WANITA', 'status' => 'AKTIF'],
            ['nim' => '21120121120036', 'name' => 'MUHAMMAD HAIDAR KHOLIL ATHALLAH', 'angkatan' => '2021', 'gender' => 'PRIA', 'status' => 'AKTIF'],
            // ... (continue for the rest of the students)
        ]);
    }
}

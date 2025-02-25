<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run()
    {
        DB::table('books')->insert([
            [
                'judul' => 'PEMROGRAMAN APLIKASI MOBILE SMARTPHONE DAN TABLET PC BERBASIS ANDROID',
                'penulis' => 'NAZARUDDIN SAFAAT H',
                'penerbit' => 'INFORMATIKA BANDUNG',
                'isbn' => '978-602-8758-52-9',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'S.12.007',
                'thumbnail' => 'book-thumbnails/thumbnail1.png',
                'synopsis' => 'Pemrograman aplikasi mobile berbasis Android untuk smartphone dan tablet PC.',
            ],
            [
                'judul' => 'PEMROGRAMAN APLIKASI MOBILE SMARTPHONE DAN TABLET PC BERBASIS ANDROID',
                'penulis' => 'NAZARUDDIN SAFAAT H',
                'penerbit' => 'INFORMATIKA BANDUNG',
                'isbn' => '978-602-8758-52-9',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'S.12.20.002',
                'thumbnail' => 'book-thumbnails/thumbnail1.png',
                'synopsis' => 'Pemrograman aplikasi mobile berbasis Android untuk smartphone dan tablet PC.',
            ],
            [
                'judul' => 'PEMROGRAMAN APLIKASI MOBILE SMARTPHONE DAN TABLET PC BERBASIS ANDROID',
                'penulis' => 'NAZARUDDIN SAFAAT H',
                'penerbit' => 'INFORMATIKA BANDUNG',
                'isbn' => '978-602-8758-52-9',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'S.12.20.003',
                'thumbnail' => 'book-thumbnails/thumbnail1.png',
                'synopsis' => 'Pemrograman aplikasi mobile berbasis Android untuk smartphone dan tablet PC.',
            ],
            [
                'judul' => 'PANDUAN LENGKAP PEMROGRAMAN ANDROID',
                'penulis' => 'ZAMRONY P. JUHARA',
                'penerbit' => 'ANDI YOGYAKARTA',
                'isbn' => '978-979-29-5346-6',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'S.12.20.004',
                'thumbnail' => null,
                'synopsis' => 'Panduan pemrograman Android lengkap untuk pengembangan aplikasi mobile.',
            ],
            [
                'judul' => 'PRO J2ME POLISH OPEN SOURCE WIRELESS JAVA TOOLS SUITE',
                'penulis' => 'ROBERT VIRKUS',
                'penerbit' => 'APRESS',
                'isbn' => '1-59059-503-3',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'P.02.200',
                'thumbnail' => null,
                'synopsis' => 'Panduan lengkap untuk menggunakan J2ME Polish untuk pengembangan Java mobile.',
            ],
            [
                'judul' => 'PEMROGRAMAN SMARTPHONE MENGGUNAKAN SDK ANDROID DAN HACKING ANDROID',
                'penulis' => 'PROF. JAZI EKO ISTIYANTO, PH.D',
                'penerbit' => 'GRAHA ILMU',
                'isbn' => '978-979-756-889-4',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'S.12.20.006',
                'thumbnail' => null,
                'synopsis' => 'Pemrograman dan hacking Android menggunakan SDK Android.',
            ],
            [
                'judul' => 'ANDROID PROGRAMMING WITH ECLIPSE',
                'penulis' => 'WAHANA KOMPUTER',
                'penerbit' => 'ANDI YOGYAKARTA',
                'isbn' => '978-979-29-4021-3',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'S.12.20.007',
                'thumbnail' => null,
                'synopsis' => 'Panduan pemrograman Android menggunakan Eclipse IDE.',
            ],
            [
                'judul' => 'RAGAM APLIKASI ANDROID UNTUK UKM',
                'penulis' => 'WAHANA KOMPUTER',
                'penerbit' => 'ANDI YOGYAKARTA',
                'isbn' => '978-979-29-4335-1',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'S.12.20.009',
                'thumbnail' => null,
                'synopsis' => 'Kumpulan aplikasi Android untuk mendukung usaha kecil dan menengah.',
            ],
            [
                'judul' => 'STEP BY STEP MENJADI PROGRAMMER ANDROID',
                'penulis' => 'WAHANA KOMPUTER',
                'penerbit' => 'ANDI YOGYAKARTA',
                'isbn' => '978-979-29-3511-0',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'S.12.20.010',
                'thumbnail' => null,
                'synopsis' => 'Panduan langkah demi langkah untuk menjadi programmer Android.',
            ],
            [
                'judul' => 'PEMROGRAMAN GRAFIK DENGAN JAVA',
                'penulis' => 'ANDIK TAUFIQ',
                'penerbit' => 'INFORMATIKA BANDUNG',
                'isbn' => '978-602-8758-15-4',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'S.12.20.014',
                'thumbnail' => null,
                'synopsis' => 'Panduan pemrograman grafik dengan bahasa pemrograman Java.',
            ],        
            [
                'judul' => 'PEMROGRAMAN GRAFIK DENGAN JAVA',
                'penulis' => 'ANDIK TAUFIQ',
                'penerbit' => 'INFORMATIKA BANDUNG',
                'isbn' => '978-602-8758-15-4',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'S.12.20.015',
                'thumbnail' => null,
                'synopsis' => 'Panduan pemrograman grafik dengan bahasa pemrograman Java.',
            ],  
            [
                'judul' => 'PEMROGRAMAN GRAFIK DENGAN JAVA',
                'penulis' => 'ANDIK TAUFIQ',
                'penerbit' => 'INFORMATIKA BANDUNG',
                'isbn' => '978-602-8758-15-4',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'S.12.20.016',
                'thumbnail' => null,
                'synopsis' => 'Panduan pemrograman grafik dengan bahasa pemrograman Java.',
            ],
            // new
            [
                'judul' => 'STEP BY STEP MENJADI PROGRAMMER ANDROID A21',
                'penulis' => 'WAHANA KOMPUTER',
                'penerbit' => 'ANDI YOGYAKARTA',
                'isbn' => '978-979-29-3511-0',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'Z.92.20.010',
                'thumbnail' => null,
                'synopsis' => 'Panduan langkah demi langkah untuk menjadi programmer Android.',
            ],            [
                'judul' => 'STEP BY STEP MENJADI PROGRAMMER ANDROID 21A',
                'penulis' => 'WAHANA KOMPUTER',
                'penerbit' => 'ANDI YOGYAKARTA',
                'isbn' => '978-979-29-3511-0',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'P.82.20.010',
                'thumbnail' => null,
                'synopsis' => 'Panduan langkah demi langkah untuk menjadi programmer Android.',
            ],            [
                'judul' => 'STEP BY STEP MENJADI PROGRAMMER ANDROID AS12',
                'penulis' => 'WAHANA KOMPUTER',
                'penerbit' => 'ANDI YOGYAKARTA',
                'isbn' => '978-979-29-3511-0',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'I.82.20.010',
                'thumbnail' => null,
                'synopsis' => 'Panduan langkah demi langkah untuk menjadi programmer Android.',
            ],            [
                'judul' => 'STEP BY STEP MENJADI PROGRAMMER ANDROID12AS',
                'penulis' => 'WAHANA KOMPUTER',
                'penerbit' => 'ANDI YOGYAKARTA',
                'isbn' => '978-979-29-3511-0',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'Y.52.20.010',
                'thumbnail' => null,
                'synopsis' => 'Panduan langkah demi langkah untuk menjadi programmer Android.',
            ],            [
                'judul' => 'STEP BY STEP MENJADI PROGRAMMER ANDROID QW12',
                'penulis' => 'WAHANA KOMPUTER',
                'penerbit' => 'ANDI YOGYAKARTA',
                'isbn' => '978-979-29-3511-0',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'V.12.20.010',
                'thumbnail' => null,
                'synopsis' => 'Panduan langkah demi langkah untuk menjadi programmer Android.',
            ],            [
                'judul' => 'STEP BY STEP MENJADI PROGRAMMER ANDROID ASAAW',
                'penulis' => 'WAHANA KOMPUTER',
                'penerbit' => 'ANDI YOGYAKARTA',
                'isbn' => '978-979-29-3511-0',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'B.52.20.010',
                'thumbnail' => null,
                'synopsis' => 'Panduan langkah demi langkah untuk menjadi programmer Android.',
            ],            [
                'judul' => 'STEP BY STEP MENJADI PROGRAMMER ANDROID QWQ',
                'penulis' => 'WAHANA KOMPUTER',
                'penerbit' => 'ANDI YOGYAKARTA',
                'isbn' => '978-979-29-3511-0',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'Z.22.20.010',
                'thumbnail' => null,
                'synopsis' => 'Panduan langkah demi langkah untuk menjadi programmer Android.',
            ],            [
                'judul' => 'STEP BY STEP MENJADI PROGRAMMER ANDROID ASA',
                'penulis' => 'WAHANA KOMPUTER',
                'penerbit' => 'ANDI YOGYAKARTA',
                'isbn' => '978-979-29-3511-0',
                'peminatan' => 'Perangkat Lunak & Mobile Computing',
                'sub_peminatan' => 'Mobile Development',
                'kode_unik' => 'A.22.20.010',
                'thumbnail' => null,
                'synopsis' => 'Panduan langkah demi langkah untuk menjadi programmer Android.',
            ],   
        ]);           
    }
}

<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    public function run()
    {
        Pegawai::insert([
            [
                'nama_lengkap' => 'Dania Eridani, S.T., M.Eng.',
                'nip_nppu_nupk' => '198910132015042002',
                'nidn_nidk_nup_nitk' => '0013108903',
                'nuptk' => '9345767668230283',
                'pangkat_golongan' => 'Penata Tk I, III/d',
                'jabatan_fungsional' => 'Lektor Kepala',
                'tugas_tambahan_1' => null,
                'tugas_tambahan_2' => null,
                'tugas_tambahan_3' => null,
                'tugas_tambahan_4' => null,
                'kepakaran' => 'Embedded System',
                'pendidikan_terakhir' => 'S2',
                'jurusan' => 'Teknik Elektro',
                'status_bekerja' => 'Aktif Bekerja',
                'status_kepegawaian' => 'PNS',
                'jenis_pegawai' => 'Tenaga Dosen',
                'unit_kerja' => 'Fakultas Teknik',
                'bagian' => 'Departemen Teknik Komputer',
                'subbagian' => 'Teknik Komputer S1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_lengkap' => 'Eko Didik Widianto, S.T., M.T.',
                'nip_nppu_nupk' => '197705262010121001',
                'nidn_nidk_nup_nitk' => '0026057713',
                'nuptk' => '4858755656130102',
                'pangkat_golongan' => 'Penata Tk I, III/d',
                'jabatan_fungsional' => 'Lektor',
                'tugas_tambahan_1' => 'Kepala Pusat Promosi dan Publikasi Hasil Penelitian Pengabdian Masyarakat',
                'tugas_tambahan_2' => null,
                'tugas_tambahan_3' => null,
                'tugas_tambahan_4' => null,
                'kepakaran' => 'Sistem Komputer',
                'pendidikan_terakhir' => 'S2',
                'jurusan' => 'Teknik Elektro',
                'status_bekerja' => 'Ijin Belajar',
                'status_kepegawaian' => 'PNS',
                'jenis_pegawai' => 'Tenaga Dosen',
                'unit_kerja' => 'Fakultas Teknik',
                'bagian' => 'Departemen Teknik Komputer',
                'subbagian' => 'Teknik Komputer S1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_lengkap' => 'Yudi Eko Windarto, S.T., M.Kom.',
                'nip_nppu_nupk' => 'H.7.198906042018071001',
                'nidn_nidk_nup_nitk' => '0004068907',
                'nuptk' => '0936767668130362',
                'pangkat_golongan' => 'Setara Penata Muda Tk I, Set. III/b',
                'jabatan_fungsional' => 'Asisten Ahli',
                'tugas_tambahan_1' => null,
                'tugas_tambahan_2' => null,
                'tugas_tambahan_3' => null,
                'tugas_tambahan_4' => null,
                'kepakaran' => 'Teknik Komputer',
                'pendidikan_terakhir' => 'S2',
                'jurusan' => 'Sistem Informasi',
                'status_bekerja' => 'Aktif Bekerja',
                'status_kepegawaian' => 'Pegawai Undip Non ASN',
                'jenis_pegawai' => 'Tenaga Dosen',
                'unit_kerja' => 'Fakultas Teknik',
                'bagian' => 'Departemen Teknik Komputer',
                'subbagian' => 'Teknik Komputer S1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_lengkap' => 'Erwan Yudi Indrasto, S.T.',
                'nip_nppu_nupk' => 'H.7.199309052021041001',
                'nidn_nidk_nup_nitk' => null,
                'nuptk' => null,
                'pangkat_golongan' => 'Setara Penata Muda, Set. III/a',
                'jabatan_fungsional' => 'Pengadministrasi Akademik',
                'tugas_tambahan_1' => null,
                'tugas_tambahan_2' => null,
                'tugas_tambahan_3' => null,
                'tugas_tambahan_4' => null,
                'kepakaran' => null,
                'pendidikan_terakhir' => 'S1',
                'jurusan' => 'Teknik Elektro',
                'status_bekerja' => 'Aktif Bekerja',
                'status_kepegawaian' => 'Pegawai Undip Non ASN',
                'jenis_pegawai' => 'Tenaga Kependidikan',
                'unit_kerja' => 'Fakultas Teknik',
                'bagian' => 'Bagian Tata Usaha FT',
                'subbagian' => 'Subbagian Akademik dan Kemahasiswaan FT',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_lengkap' => 'Fathia Fidiniari, A.Md.Kom.',
                'nip_nppu_nupk' => 'H.7.199809202023102001',
                'nidn_nidk_nup_nitk' => null,
                'nuptk' => null,
                'pangkat_golongan' => 'Setara Pengatur, Set. II/c',
                'jabatan_fungsional' => 'Teknisi Laboratorium',
                'tugas_tambahan_1' => null,
                'tugas_tambahan_2' => null,
                'tugas_tambahan_3' => null,
                'tugas_tambahan_4' => null,
                'kepakaran' => null,
                'pendidikan_terakhir' => 'D3',
                'jurusan' => 'Teknik Elektro',
                'status_bekerja' => 'Aktif Bekerja',
                'status_kepegawaian' => 'Calon Pegawai Undip Non ASN',
                'jenis_pegawai' => 'Tenaga Kependidikan',
                'unit_kerja' => 'Fakultas Teknik',
                'bagian' => 'Bagian Tata Usaha FT',
                'subbagian' => 'Subbagian Akademik dan Kemahasiswaan FT',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}

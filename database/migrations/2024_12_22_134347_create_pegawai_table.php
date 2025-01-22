<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->string('nama_lengkap');
            $table->string('nip_nppu_nupk')->unique()->primary();
            $table->string('nidn_nidk_nup_nitk')->nullable();
            $table->string('nuptk')->nullable();
            $table->string('pangkat_golongan')->nullable();
            $table->string('jabatan_fungsional')->nullable();
            $table->string('tugas_tambahan_1')->nullable();
            $table->string('tugas_tambahan_2')->nullable();
            $table->string('tugas_tambahan_3')->nullable();
            $table->string('tugas_tambahan_4')->nullable();
            $table->string('kepakaran')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('status_bekerja')->nullable();
            $table->string('status_kepegawaian')->nullable();
            $table->enum('jenis_pegawai', ['Tenaga Dosen', 'Tenaga Kependidikan']);
            $table->string('unit_kerja')->nullable();
            $table->string('bagian')->nullable();
            $table->string('subbagian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};

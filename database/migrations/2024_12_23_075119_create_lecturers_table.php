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
        Schema::create('lecturers', function (Blueprint $table) {
            $table->string('nip')->primary()->references('userid')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->string('kode_dosen');
            $table->string('riwayat_s1');
            $table->string('riwayat_s2');
            $table->string('riwayat_s3')->nullable();
            $table->string('kepakaran1');
            $table->string('kepakaran2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturers');
    }
};

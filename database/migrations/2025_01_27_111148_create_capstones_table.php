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
        Schema::create('capstones', function (Blueprint $table) {
            $table->id(); 
            $table->string('kode_kelompok')->unique(); 
            $table->string('anggota1_nim')->nullable(); 
            $table->string('anggota2_nim')->nullable(); 
            $table->string('anggota3_nim')->nullable(); 
            $table->string('kategori'); 
            $table->string('judul_capstone'); 
            $table->string('c100_path')->nullable(); 
            $table->string('c200_path')->nullable(); 
            $table->string('c300_path')->nullable(); 
            $table->string('c400_path')->nullable(); 
            $table->string('c500_path')->nullable(); 
            $table->timestamps(); 

            // Set foreign key constraints
            $table->foreign('anggota1_nim')->references('nim')->on('students')->onDelete('set null');
            $table->foreign('anggota2_nim')->references('nim')->on('students')->onDelete('set null');
            $table->foreign('anggota3_nim')->references('nim')->on('students')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('capstones');
    }
};

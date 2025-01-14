<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tugasakhirs', function (Blueprint $table) {
            $table->id(); 
            $table->string('nim'); 
            $table->foreign('nim')->references('userid')->on('users')->onDelete('cascade'); 
            $table->string('title'); 
            $table->string('full_document'); 
            $table->string('cover_abstract'); 
            $table->string('bab1_pendahuluan'); 
            $table->string('bab2_kajianpustaka'); 
            $table->string('bab3_perancangan'); 
            $table->string('bab4_hasilpembahasan'); 
            $table->string('bab5_penutup'); 
            $table->string('lampiran'); 
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugasakhirs');
    }
};

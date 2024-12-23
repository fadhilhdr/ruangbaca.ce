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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            // userid bisa nim, nip, atau kalau nim mahasiswa non tekkom (tidak terdaftar di db) bisa dikosongkan dan langsung mengisi nama saja
            $table->string('userid'); 
            $table->string('name');
            $table->timestamp('check_in_at')->nullable();
            $table->timestamp('check_out_at')->nullable();
            $table->timestamps();
            $table->foreign('nim')->references('nim')->on('students');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitors');
    }
};

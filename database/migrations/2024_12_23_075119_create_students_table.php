<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('nim')->primary()->references('userid')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->string('angkatan');
            $table->string('gender');
            $table->string('status_terakhir');
            $table->string('prodi');
            $table->string('jalur_masuk');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('kode_unik')->unique(); 
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit');
            $table->string('isbn');
            $table->string('peminatan');
            $table->string('sub_peminatan');
            $table->string('thumbnail')->nullable(); 
            $table->text('synopsis')->nullable(); 
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}


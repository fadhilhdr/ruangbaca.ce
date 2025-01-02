<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookLoansTable extends Migration
{
    public function up()
    {
        Schema::create('book_loans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_unik_buku');
            $table->foreign('kode_unik_buku')->references('kode_unik')->on('books')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('user_id');
            $table->foreign('user_id')->references('userid')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->dateTime('loan_date'); 
            $table->dateTime('due_date'); 
            $table->dateTime('return_date')->nullable(); 
            $table->integer('renewal_count')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('book_loans');
    }
};

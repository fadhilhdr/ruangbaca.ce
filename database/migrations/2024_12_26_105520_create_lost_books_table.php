<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLostBooksTable extends Migration
{
    public function up()
    {
        Schema::create('lost_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_loan_id')->constrained('book_loans')->cascadeOnDelete();
            $table->timestamp('date_reported');
            $table->enum('replacement_status', ['awaiting_verif', 'verified', 'decline']); // ENUM untuk status penggantian
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lost_books');
    }
}


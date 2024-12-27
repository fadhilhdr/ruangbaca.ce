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
            $table->foreignId('book_id')->constrained('books');
            $table->string('user_id'); // NIM/NIP
            $table->dateTime('loan_date'); // Ganti ke DATETIME
            $table->dateTime('due_date'); // Ganti ke DATETIME
            $table->dateTime('return_date')->nullable(); // Ganti ke DATETIME
            $table->integer('renewal_count')->default(0);
            $table->decimal('fine_amount', 10, 2)->default(0.00);
            $table->enum('loan_status', ['On Loan', 'Renewed', 'Returned', 'Overdue']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('book_loans');
    }
};

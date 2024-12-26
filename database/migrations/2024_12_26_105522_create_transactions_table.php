<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_loan_id')->constrained('book_loans');
            $table->enum('transaction_type', ['Borrow', 'Return', 'Renewal', 'Fine Payment', 'Lost Book Replacement']); 
            $table->decimal('amount', 10, 2); // Amount dalam IDR
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}


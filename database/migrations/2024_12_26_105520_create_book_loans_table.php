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
            $table->timestamp('loan_date');
            $table->timestamp('due_date');
            $table->timestamp('return_date')->nullable();
            $table->integer('renewal_count')->default(0);
            $table->decimal('fine_amount', 10, 2)->default(0.00);
            $table->enum('loan_status', ['On Loan', 'Renewed', 'Returned', 'Overdue']); // ENUM untuk status pinjaman
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('book_loans');
    }
};

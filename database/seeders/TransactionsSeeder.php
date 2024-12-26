<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('transactions')->insert([
            [
                'book_loan_id' => 1, // 'Introduction to Algorithms' loan by Fikri
                'transaction_type' => 'Borrow', // Type of transaction
                'amount' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_loan_id' => 2, // 'Computer Networking: A Top-Down Approach' loan by Fadhil
                'transaction_type' => 'Borrow',
                'amount' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);        
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookLoansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('book_loans')->insert([
            [
                'book_id' => 1, // 'Introduction to Algorithms'
                'user_id' => '21120121140033', // Fikri Abdurrohim Ibnu Prabowo (Member)
                'loan_date' => now(),
                'due_date' => now()->addDays(14),
                'return_date' => null,
                'renewal_count' => 0,
                'fine_amount' => 0,
                'loan_status' => 'On Loan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'book_id' => 2, // 'Computer Networking: A Top-Down Approach'
                'user_id' => '21120121130120', // Fadhil Hadrian Azzami (Admin)
                'loan_date' => now(),
                'due_date' => now()->addDays(14),
                'return_date' => null,
                'renewal_count' => 0,
                'fine_amount' => 0,
                'loan_status' => 'On Loan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}

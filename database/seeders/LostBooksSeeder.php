<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LostBooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('lost_books')->insert([
            [
                'book_loan_id' => 1, // 'Introduction to Algorithms' loan by Fikri
                'book_id' => 1, // 'Introduction to Algorithms'
                'user_id' => '21120121140033', // Fikri Abdurrohim Ibnu Prabowo
                'date_reported' => now(),
                'replacement_status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);        
    }
}

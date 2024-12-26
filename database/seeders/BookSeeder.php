<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run()
    {
        DB::table('books')->insert([
            [
                'isbn' => '978-0134190440',
                'title' => 'Introduction to Algorithms',
                'author' => 'Thomas H. Cormen',
                'stock' => 5,
                'specialization_id' => 1, // Software
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-0201633610',
                'title' => 'Computer Networking: A Top-Down Approach',
                'author' => 'James Kurose, Keith Ross',
                'stock' => 3,
                'specialization_id' => 2, // Networking
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-0134184975',
                'title' => 'Digital Design and Computer Architecture',
                'author' => 'David Money Harris',
                'stock' => 4,
                'specialization_id' => 3, // Multimedia
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'isbn' => '978-0128015451',
                'title' => 'Embedded Systems: Introduction to ARM Cortex-M Microcontrollers',
                'author' => 'Jonathan W. Valvano',
                'stock' => 2,
                'specialization_id' => 4, // Embedded System
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
    }
}

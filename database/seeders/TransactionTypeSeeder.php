<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TransactionType;

class TransactionTypeSeeder extends Seeder
{
    public function run()
    {
        $types = ['Borrow', 'Renewal', 'Return', 'Fine Payment', 'Lost Book Replacement'];

        foreach ($types as $type) {
            TransactionType::create(['type_name' => $type]);
        }
    }
}
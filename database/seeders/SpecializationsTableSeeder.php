<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specialization;

class SpecializationsTableSeeder extends Seeder
{
    public function run()
    {
        Specialization::create(['name' => 'Software']);
        Specialization::create(['name' => 'Networking']);
        Specialization::create(['name' => 'Multimedia']);
        Specialization::create(['name' => 'Embedded System']);
    }
}


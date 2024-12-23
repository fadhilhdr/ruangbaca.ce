<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan data default untuk roles
        DB::table('roles')->insert([
            ['name' => 'Member'],
            ['name' => 'Admin'],
            ['name' => 'Superadmin'],
        ]);
    }
}


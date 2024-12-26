<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'userid' => '21120121140033',
                'name' => 'Fikri Abdurrohim Ibnu Prabowo',
                'password' => bcrypt('password'),
                'role_id' => 1,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'userid' => '21120121130120',
                'name' => 'Fadhil Hadrian Azzami',
                'password' => bcrypt('password'),
                'role_id' => 2,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'userid' => '21120121130074',
                'name' => 'Putrandi Agung Prabowo',
                'password' => bcrypt('password'),
                'role_id' => 3,
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
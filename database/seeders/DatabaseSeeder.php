<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolesTableSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(LecturerSeeder::class);
    }
}

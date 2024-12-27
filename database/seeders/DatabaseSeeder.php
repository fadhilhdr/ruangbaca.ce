<?php

namespace Database\Seeders;

use App\Models\BookLoan;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolesTableSeeder::class);
        $this->call(SpecializationsTableSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(LecturerSeeder::class);
        $this->call(UsersSeeder::class);

        // Tahap 2 perbukuan
        $this->call(BookSeeder::class);
        $this->call(BookLoansSeeder::class);
        $this->call(LostBooksSeeder::class);
        $this->call(TransactionsSeeder::class);
    }
}
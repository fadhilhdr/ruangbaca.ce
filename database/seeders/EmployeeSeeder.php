<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            [
                'nip' => '198901152008021002',
                'name' => 'John Doe',
                'division' => 'Human Resources',
            ],
            [
                'nip' => '199402262010031003',
                'name' => 'Jane Smith',
                'division' => 'Finance',
            ],
            [
                'nip' => '198203192007022005',
                'name' => 'Michael Johnson',
                'division' => 'IT Support',
            ],
            [
                'nip' => '199012131999032004',
                'name' => 'Emily Davis',
                'division' => 'Marketing',
            ],
            [
                'nip' => '199305231999092008',
                'name' => 'David Wilson',
                'division' => 'Sales',
            ],
        ]);
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Member'],
            ['id' => 2, 'name' => 'Admin'],
            ['id' => 3, 'name' => 'Superadmin'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}

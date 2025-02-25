<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name' => 'admin', 'type' => 1],
            ['name' => 'client', 'type' => 2],
            ['name' => 'freelancer', 'type' => 3],
        ]);
    }
}

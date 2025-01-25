<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::create(['name' => 'CEO']);
        Group::create(['name' => 'Manager']);
        Group::create(['name' => 'Employee']);
        Group::create(['name' => 'Intern']);
        Group::create(['name' => 'HR']);
    }
}

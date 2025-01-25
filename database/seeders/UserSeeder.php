<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $group = Group::create(['name' => 'admin']);

        $user = User::create([
            'name' => 'John Doe',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin@admin.com'),
        ]);

        $user->groups()->attach($group->id);
    }
}

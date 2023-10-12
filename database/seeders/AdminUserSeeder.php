<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@store.io',
            'password' => Hash::make('password'),
        ])->assignRole('admin');

        User::create([
            'name' => 'Client',
            'email' => 'client@store.io',
            'password' => Hash::make('password'),
        ])->assignRole('client');
    }
}

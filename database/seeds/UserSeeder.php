<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            [
                'username' => 'heru',
                'password' => Hash::make('admin'),
                'name' => 'Heru',
                'role' => 'Admin'
            ],
            [
                'username' => 'setiawan',
                'password' => Hash::make('karyawan'),
                'name' => 'Setiawan',
                'role' => 'Karyawan'
            ]
        ]);
    }
}

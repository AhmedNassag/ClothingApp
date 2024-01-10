<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'username'     => 'Ahmed Nabil',
            'email'    => 'ahmednassag@gmail.com',
            'password' => bcrypt('12345678'),
        ]);


        $admin = User::create([
            'username'     => 'Eslam Salah',
            'email'    => 'eslam@gmail.com',
            'password' => bcrypt('12345678'),
        ]);


        $admin = User::create([
            'username'     => 'karim Mohamed',
            'email'    => 'karim@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}

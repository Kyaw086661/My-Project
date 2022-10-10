<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       User::create([
        'name'=>'admin',
        'email'=> 'admin@gmail.com',
        'gender' => 'male',
        'address'=> 'Yangon',
        'role' => 'admin',
        'phone' => '09980111168',
        'password' => Hash::make('admin123')
       ]);


    }
}

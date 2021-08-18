<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Seeder\DatabaseSeeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate(); //for cleaning earlier data to avoid duplicate entries
        DB::table('users')->insert([
            'name' => 'admin user',
            'email' => 'iamadmin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
          ]);
          DB::table('users')->insert([
            'name' => 'cdAdmin user',
            'email' => 'iamcduser@gmail.com',
            'role' => 'cdAdmin',
            'password' => Hash::make('password'),
          ]);
          DB::table('users')->insert([
            'name' => 'bookAdmin user',
            'email' => 'iambookuser@gmail.com',
            'role' => 'bookAdmin',
            'password' => Hash::make('password'),
          ]);
          DB::table('users')->insert([
            'name' => 'customer',
            'email' => 'iamcustomer@gmail.com',
            'role' => 'customer',
            'password' => Hash::make('password'),
          ]);
    }
}

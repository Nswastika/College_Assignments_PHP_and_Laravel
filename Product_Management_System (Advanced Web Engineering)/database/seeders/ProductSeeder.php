<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Seeder\DatabaseSeeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate(); //for cleaning earlier data to avoid duplicate entries
        DB::table('users')->insert([
            'user_id' => 1,
            'type'=> 'cd',
            'title' => 'Mountains',
            'firstname'=> 'John',
            'surname'=> 'Doe',
            'price'=>100,
            'papl'=>120,
        ]);
        DB::table('users')->insert([
            'user_id' => 2,
            'type'=> 'cd',
            'title' => 'Mountains',
            'firstname'=> 'John',
            'surname'=> 'Doe',
            'price'=>100,
            'papl'=>120,
        ]);
    }
}

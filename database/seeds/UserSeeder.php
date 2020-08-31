<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Bogdan Aichimoaie",
            'email' => 'bogdan@gmail.com',
            'password' => bcrypt('sample123'),//Hash::make('password'),
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            "username" => "admin",
            "name" => "admin",
            "email" => "admin@code.com",
            "password" => \Illuminate\Support\Facades\Hash::make("admin"),
            "role_id" => 1,
            "active"=>1
        ]);
    }
}

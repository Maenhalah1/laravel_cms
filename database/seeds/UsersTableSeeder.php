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
            "name" => Illuminate\Support\Str::random(8),
            "email" => Illuminate\Support\Str::random(8) . "@code.com",
            "password" => password_hash('secret', PASSWORD_DEFAULT),
            "role_id" => 1,
            "active"=>1
        ]);
    }
}

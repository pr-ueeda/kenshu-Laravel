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
        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => '私の名前はアイウエオ',
            'email'        => 'sample@sample.com',
            'password'     => \Illuminate\Support\Facades\Hash::make('password'),
            'updated_at'   => new DateTime(),
            'created_at'   => new DateTime()
        ]);
    }
}

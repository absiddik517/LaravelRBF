<?php

use Illuminate\Database\Seeder;
use app\User;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'A.B. Siddik',
            'email' => 'absiddik517@gmail.com',
            'password' => bcrypt('siddik.com')
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => 'Awam Victor',
            'email' => 'Testmail@gmail.com',
            'password' => bcrypt('secret'),
            'country'=>'Nigeria',
            'phone'=>'08022851219',
            'type'=>'admin'
        ]);
    }
}

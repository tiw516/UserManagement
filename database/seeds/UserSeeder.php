<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * create the first user as admin user
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin12345'),
                'active' => '1',
                'ifadmin' => '1',
            ],
            
        ]);


        
    }
}

<?php

use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact')->insert([
            [
                'user_id' => '1',
                'default' => 'Yes',
            ],
            
        ]);
    }
}

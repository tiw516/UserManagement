<?php

use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('address')->insert([
            [
                'user_id' => '1',
                'streetaddress' => 'null',
                'city' => 'null',
                'province' => 'null',
                'country' => 'null',
                'postalcode' => 'null',
                'default' => 'Yes',
            ],
            
        ]);
    }
}

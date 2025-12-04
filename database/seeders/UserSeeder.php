<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            'identificationNac' => 'V',
            'identificationNumber' => '12966576',
            'name' => 'alex',
            'names' => 'Alexander',
            'surnames' => 'Diaz',
            'email' => 'ddrsistemas@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('datos_basicos')->insert([
            'user_id' => 1,
            'cellphonecode' => '0414',
            'cellphone' => '1899016',
            'address' => 'Caracas, San Bernardino',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('clients')->insert([
            'user_id' => 1,
            'comercio_id' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('users')->insert([
            'identificationNac' => 'V',
            'identificationNumber' => '13053081',
            'name' => 'jose',
            'names' => 'José',
            'surnames' => 'Rosales',
            'email' => 'typej2003@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('datos_basicos')->insert([
            'user_id' => 1,
            'cellphonecode' => '0416',
            'cellphone' => '5800403',
            'address' => 'Caracas, San Bernardino',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

       

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User2Seeder extends Seeder
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
            'identificationNumber' => '13053082',
            'name' => 'usuario 3',
            'names' => 'Usuario3',
            'surnames' => 'Apellidos3',
            'email' => 'usuario3@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'afiliado',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('datos_basicos')->insert([
            'user_id' => 3,
            'cellphonecode' => '0416',
            'cellphone' => '5800403',
            'address' => 'Cumana-Villa Felicidad I',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('users')->insert([
            'identificationNac' => 'V',
            'identificationNumber' => '20111222',
            'name' => 'usuario 4',
            'names' => 'Usuario4',
            'surnames' => 'Apellido4',
            'email' => 'usuario4@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'afiliado',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('datos_basicos')->insert([
            'user_id' => 4,
            'cellphonecode' => '0416',
            'cellphone' => '5800403',
            'address' => 'Cumana-Villa Felicidad I',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
    }
}

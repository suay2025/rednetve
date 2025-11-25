<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MotorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('motors')->insert([
            'name' => 'Motor 1.4',
            'user_id' => 1,
            'area_id' => 2,
            'manufacturer_id' => 1,
            'modelo_id' => 1,
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('motors')->insert([
            'name' => 'Motor 1.8',
            'user_id' => 1,
            'area_id' => 2,
            'manufacturer_id' => 1,
            'modelo_id' => 1,
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('motors')->insert([
            'name' => 'Motor 2.1',
            'user_id' => 1,
            'area_id' => 2,
            'manufacturer_id' => 1,
            'modelo_id' => 2,
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
    }
}

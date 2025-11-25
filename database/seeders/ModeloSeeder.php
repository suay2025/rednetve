<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modelos')->insert([
            'name' => 'CLIO I',
            'user_id' => 1,
            'area_id' => 2,
            'manufacturer_id' => 1,
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('modelos')->insert([
            'name' => 'CLIO II',
            'user_id' => 1,
            'area_id' => 2,
            'manufacturer_id' => 1,
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('modelos')->insert([
            'name' => 'CLIO III',
            'user_id' => 1,
            'area_id' => 2,
            'manufacturer_id' => 2,
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
    }
}
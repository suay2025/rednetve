<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufacturersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */ 
    public function run()
    {
        DB::table('manufacturers')->insert([
            'name' => 'Panaderia Expreso',
            'avatar' => 'logo_expreso.jpg',
            'mercado' => 'original',
            'area_id' => '1',
            'user_id' => '1',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('manufacturers')->insert([
            'name' => 'Doralta',
            'avatar' => 'logo_doralta.jpg',
            'mercado' => 'original',
            'area_id' => '1',
            'user_id' => '1',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('manufacturers')->insert([
            'name' => 'Olandely',
            'avatar' => 'logo_olandely.jpg',
            'mercado' => 'original',
            'area_id' => '1',
            'user_id' => '1',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('manufacturers')->insert([
            'name' => 'Coffetown',
            'avatar' => 'logo_coffetown.jpg',
            'mercado' => 'original',
            'area_id' => '1',
            'user_id' => '1',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('manufacturers')->insert([
            'name' => 'Titanium',
            'avatar' => 'logo_titanium.jpg',
            'mercado' => 'original',
            'area_id' => '1',
            'user_id' => '1',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('manufacturers')->insert([
            'name' => 'Candelaria',
            'avatar' => 'logo_candelaria.jpg',
            'mercado' => 'original',
            'area_id' => '1',
            'user_id' => '1',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('manufacturers')->insert([
            'name' => 'Gama',
            'avatar' => 'logo_gama.jpg',
            'mercado' => 'original',
            'area_id' => '1',
            'user_id' => '1',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('manufacturers')->insert([
            'name' => 'Rio',
            'avatar' => 'logo_rio.jpg',
            'mercado' => 'original',
            'area_id' => '1',
            'user_id' => '1',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('manufacturers')->insert([
            'name' => 'Vollmer Bakery',
            'avatar' => 'logo_vollmer.jpg',
            'mercado' => 'original',
            'area_id' => '1',
            'user_id' => '1',
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

    }
}

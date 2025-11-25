<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Category Marca
        DB::table('subcategories')->insert([
            'name' => 'Wifi expres',
            'avatar' => 'wifiexpres_logo.png',
            'user_id' => '1',
            'comercio_id' => '1',
            'category_id' => '1',
            'itemMenu' => '1',
            'itemSubmenu' => '1',
            'posicionMenu' => 1,
            'posicionSubmenu' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);        

        DB::table('subcategories')->insert([
            'name' => 'Hotdog 1',
            'avatar' => 'logo_doralta.jpg',
            'user_id' => '1',
            'comercio_id' => '1',
            'category_id' => '1',
            'itemMenu' => '1',
            'itemSubmenu' => '1',
            'posicionMenu' => 1,
            'posicionSubmenu' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);        

        

    }
}

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
            'name' => 'Panaderia expreso',
            'avatar' => 'panexpres_logo.png',
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
            'name' => 'Panaderia Doralta',
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

        DB::table('subcategories')->insert([
            'name' => 'Panadería OLANDELY',
            'avatar' => 'logo_olandely.jpg',
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
            'name' => 'Coffetown',
            'avatar' => 'logo_coffetown.jpg',
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
            'name' => 'Titanium',
            'avatar' => 'logo_titanium.jpg',
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
            'name' => 'Panaderia Candelaria',
            'avatar' => 'logo_candelaria.jpg',
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
            'name' => 'Gama',
            'avatar' => 'logo_gama.jpg',
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
            'name' => 'Rio',
            'avatar' => 'logo_rio.jpg',
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
            'name' => 'Vollmer Bakery',
            'avatar' => 'vollmerbakery.png',
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

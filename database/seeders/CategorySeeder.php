<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Panaderia',
            'avatar' => '',
            'user_id' => '1',
            'comercio_id' => '1',
            'itemMenu' => '1',
            'itemSubmenu' => '1',
            'posicionMenu' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('categories')->insert([
            'name' => 'Pan',
            'avatar' => '',
            'user_id' => '1',
            'comercio_id' => '1',
            'itemMenu' => '0',
            'itemSubmenu' => '0',
            'posicionMenu' => 2,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('categories')->insert([
            'name' => 'Bebida',
            'avatar' => '',
            'user_id' => '1',
            'comercio_id' => '1',
            'itemMenu' => '0',
            'itemSubmenu' => '0',
            'posicionMenu' => 3,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);        

    }
}


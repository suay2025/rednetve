<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('menus')->insert([
            'texto' => 'Vende desde Acá',
            'ruta' => 'vendedesdeaca',
            'origen' => 'categories', // view or categories
            'menu' => 1,
            'posicion' => 7,
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('menus')->insert([
            'texto' => 'Aliados',
            'ruta' => 'comercios',
            'origen' => 'categories', // view or categories
            'menu' => 1,
            'posicion' => 8,
            'comercio_id' => '1',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

    }
}

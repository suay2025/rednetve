<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingComercio2Seender extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting_comercios')->insert([
            'user_id' => '1',
            'comercio_id' => '2',
            'site_name' => 'RepuestoExpres',
            'site_email' => 'repuestoexpres@gmail.com',
            'site_title' => 'RepuestoExpres',
            'footer_text' => '',
            'sidebar_collapse' => false,
            'in_cellphonecontact' => true,  
            'in_sliderprincipal' => true,
            'currency' => '$',
            'api_bcv' => 'NO',
            'in_impuesto' => 'SI',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('setting_comercios')->insert([
            'user_id' => '1',
            'comercio_id' => '3',
            'site_name' => 'RepuestoExpres',
            'site_email' => 'repuestoexpres@gmail.com',
            'site_title' => 'RepuestoExpres',
            'footer_text' => '',
            'sidebar_collapse' => false,
            'in_cellphonecontact' => true,  
            'in_sliderprincipal' => true,
            'currency' => '$',
            'api_bcv' => 'NO',
            'in_impuesto' => 'SI',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);


    }
}

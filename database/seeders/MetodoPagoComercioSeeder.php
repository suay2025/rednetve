<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodoPagoComercioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('metodo_pago_c_s')->insert([
            'comercio_id' => '1',
            'metodo' => 'transferencia',
            'banco' => 'BBVA PROVINCIAL',
            'codigo' => '0108',
            'tipocuenta' => 'cuenta', // view or categories
            'nrocuenta' => ' 01080207580100002464',
            'titular' => 'Alexander Díaz',
            'identificationNac' => 'V',
            'identificationNumber' => '12966576',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('metodo_pago_c_s')->insert([
            'comercio_id' => '1',
            'metodo' => 'pagomovil',
            'banco' => 'BBVA PROVINCIAL',
            'codigo' => '0108 ',
            'identificationNac' => 'V',
            'identificationNumber' => '12966576',
            'cellphonecode' => '0414',
            'cellphone' => '1899016 ',            
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('metodo_pago_c_s')->insert([
            'comercio_id' => '1',
            'metodo' => 'pagoonline',
            'identificationNac' => 'V',
            'identificationNumber' => '13053081',
            'cellphonecode' => '0416',
            'cellphone' => '5800403',
            'pagoonline' => 'zelle',
            'email' => 'ddrsistemas@gmail.com',   
            'titular' => 'Alejandro Valoz',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('metodo_pago_c_s')->insert([
            'comercio_id' => '1',
            'metodo' => 'pagoonline',
            'identificationNac' => 'V',
            'identificationNumber' => '13053081',
            'cellphonecode' => '0416',
            'cellphone' => '5800403',
            'pagoonline' => 'paypal',
            'email' => 'ddrsystems@gmail.com',   
            'titular' => 'DDR Systems Corp',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
    }
}

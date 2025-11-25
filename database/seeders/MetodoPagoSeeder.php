<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('metodo_pagos')->insert([
            'metodopago' => 'EFECTIVO',
            'metodo' => 'efectivo',
            'descripcion' => '',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('metodo_pagos')->insert([
            'metodopago' => 'TARJETA',
            'metodo' => 'tarjeta',
            'descripcion' => '',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('metodo_pagos')->insert([
            'metodopago' => 'CUENTA BANCARIA',
            'metodo' => 'cuentabancaria',
            'descripcion' => '',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('metodo_pagos')->insert([
            'metodopago' => 'TRANSFERENCIA',
            'metodo' => 'transferencia',
            'descripcion' => '',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('metodo_pagos')->insert([
            'metodopago' => 'PAGO MOVIL',
            'metodo' => 'pagomovil',
            'descripcion' => '',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('metodo_pagos')->insert([
            'metodopago' => 'BIOPAGO',
            'metodo' => 'biopago',
            'descripcion' => '',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('metodo_pagos')->insert([
            'metodopago' => 'PAGO ONLINE',
            'metodo' => 'pagoonline',
            'descripcion' => 'zelle',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('metodo_pagos')->insert([
            'metodopago' => 'PAGO ONLINE',
            'metodo' => 'pagoonline',
            'descripcion' => 'paypal',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('metodo_pagos')->insert([
            'metodopago' => 'EXCHANGE',
            'metodo' => 'exchange',
            'descripcion' => '',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

    }
}

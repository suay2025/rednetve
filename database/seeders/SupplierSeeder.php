<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            'name' => 'PROVEEDOR 1',
            'rif' => 'J-20111222',
            'email' => 'proveedor1@gmail.com',
            'address' => 'CARACAS VENEZUELA',
            'phone' => '04165080408',
            'area_id' => 2,
            'comercio_id' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

    }
}

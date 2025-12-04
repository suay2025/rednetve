<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RouterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('routers')->insert([   
            'user_id' => 1,
            'ip' => '192.168.1.6',
            'macAddress' => '48:A9:8A:8E:7A:D7',
            'dns' => 'typej.ddns.net',
            'identity' => 'Mikrotik 1',
            'admin' => 'jose',
            'password' => '123',
            'location' => 'Caracas, San Bernardino',
            'nrorouter' => 'R001',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('routers')->insert([   
            'user_id' => 1,
            'ip' => '192.168.1.7',
            'macAddress' => '48:A9:8A:8E:7A:D8',
            'dns' => 'he908mt2n80.sn.mynetname.net',
            'identity' => 'Mikrotik 2 Ficticio',
            'admin' => 'jose',
            'password' => '123',
            'location' => 'Caracas, San Martin',
            'nrorouter' => 'R002',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('routers')->insert([   
            'user_id' => 2,
            'ip' => '192.168.1.8',
            'macAddress' => '48:A9:8A:8E:7A:D8',
            'dns' => 'he908mt2n99.sn.mynetname.net',
            'identity' => 'Mikrotik 3 Ficticio',
            'admin' => 'jose',
            'password' => '123',
            'location' => 'Caracas, Libertador',
            'nrorouter' => 'R003',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
    }

    
}

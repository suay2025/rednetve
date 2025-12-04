<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromocionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promocions')->insert([   
            'product_id' => 2,
            'comercio_id' => 2,
            'title' => 'combo Expreso',
            'avatar' => 'banner_combo_expreso.jpg',
            'order' => 1,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('promocions')->insert([   
            'product_id' => 12,
            'comercio_id' => 7,
            'title' => 'combo Candelaria',
            'avatar' => 'banner_combo_candelaria.jpg',
            'order' => 2,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('promocions')->insert([   
            'product_id' => 8,
            'comercio_id' => 5,
            'title' => 'combo Coffetown',
            'avatar' => 'banner_combo_coffetown.jpg',
            'order' => 3,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('promocions')->insert([   
            'product_id' => 4,
            'comercio_id' => 3,
            'title' => 'combo Doralta',
            'avatar' => 'banner_combo_doralta.jpg',
            'order' => 4,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('promocions')->insert([   
            'product_id' => 14,
            'comercio_id' => 8,
            'title' => 'combo Gama',
            'avatar' => 'banner_combo_gama.jpg',
            'order' => 5,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
        
        DB::table('promocions')->insert([   
            'product_id' => 6,
            'comercio_id' => 4,
            'title' => 'combo Olandely',
            'avatar' => 'banner_combo_olandely.jpg',
            'order' => 6,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        DB::table('promocions')->insert([   
            'product_id' => 10,
            'comercio_id' => 6,
            'title' => 'combo Titanium',
            'avatar' => 'banner_combo_titanium.jpg',
            'order' => 7,
            'active' => 'active',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
    }
}

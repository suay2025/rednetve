<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class ComercioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // id 1
        DB::table('comercios')->insert([
            'area_id' => '1',
            'user_id' => '1',
            'keyword' => 'panexpres',
            'name' => 'PanExpres',
            'avatar' => 'panexpres_logo.png',
            'banner' => 'panexpres_banner.png',
            'contactcellphone' => '04265173538',
            'contactphone'  => '0212-578-44-68',
            'msgcontact'  => 'Hola, te asesoramos por  whatsapp gestiona tu compra por este canal.',
            'horario'  => 'Lunes a Domingo hora: 6:30 am a 8:00 pm',
            'email'  => 'panexpres1@gmail.com',
            'youtube'  => 'https://www.youtube.com/@ddrsistemas',
            'twitter'  => 'https://www.youtube.com/@ddrsistemas',
            'facebook'  => 'https://www.youtube.com/@ddrsistemas',
            'instagram'  => 'https://www.instagram.com/panexpres.vzla/',
            'dominio' => 'http://www.repuestoexpres.com',
            'address'  => 'Caracas, Venezuela',
            'rifLetter' => 'J',
            'rifNumber' => '31512955-8',
            // 'dominio' => 'http://www.repuestoexpres.com',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
        // id 2
        DB::table('comercios')->insert([
            'area_id' => '1',
            'user_id' => '2',
            'keyword' => 'panaderiaexpreso',
            'name' => 'Panaderia expreso',
            'avatar' => 'panexpres_logo.png',
            'banner' => 'nickpanaderia.png',
            'contactcellphone' => '04162222222',
            'contactphone'  => '0212-222-22-22',
            'horario'  => 'Lunes a Domingo hora: 6:30 am a 8:00 pm',
            'email'  => 'panaderiaexpreso@gmail.com',
            'youtube'  => 'https://www.youtube.com/@ddrsistemas',
            'instagram'  => 'https://instagram/panexpres.vezla',
            'twitter'  => 'https://www.youtube.com/@ddrsistemas',
            'facebook'  => 'https://www.youtube.com/@ddrsistemas',
            'dominio' => 'http://www.repuestoexpres.com',
            'address'  => 'Caracas, Venezuela',
            'rifLetter' => 'J',
            'rifNumber' => '22222222-8',
            // 'dominio' => 'http://www.repuestoexpres.com',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
        // id 3
        DB::table('comercios')->insert([
            'area_id' => '1',
            'user_id' => '3',
            'keyword' => 'panaderiadoralta',
            'name' => 'Panaderia Doralta',
            'avatar' => 'logo_doralta.jpg',
            'banner' => 'logo_doralta.png',
            'contactcellphone' => '04162222222',
            'contactphone'  => '0212-222-22-22',
            'horario'  => 'Lunes a Domingo hora: 6:30 am a 8:00 pm',
            'email'  => 'panaderiaexpreso@gmail.com',
            'youtube'  => 'https://www.youtube.com/@ddrsistemas',
            'twitter'  => 'https://www.youtube.com/@ddrsistemas',
            'facebook'  => 'https://www.youtube.com/@ddrsistemas',
            'dominio' => 'http://www.repuestoexpres.com',
            'address'  => 'Caracas, Venezuela',
            'rifLetter' => 'J',
            'rifNumber' => '22222222-8',
            // 'dominio' => 'http://www.repuestoexpres.com',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
        // id 4
        DB::table('comercios')->insert([
            'area_id' => '1',
            'user_id' => '4',
            'keyword' => 'panaderiaolandely',
            'name' => 'Panadería OLANDELY',
            'avatar' => 'logo_olandely.jpg',
            'banner' => 'logos_olandely_01.png',
            'contactcellphone' => '04162222222',
            'contactphone'  => '0212-222-22-22',
            'horario'  => 'Lunes a Domingo hora: 6:30 am a 8:00 pm',
            'email'  => 'panaderiaexpreso@gmail.com',
            'youtube'  => 'https://www.youtube.com/@ddrsistemas',
            'twitter'  => 'https://www.youtube.com/@ddrsistemas',
            'facebook'  => 'https://www.youtube.com/@ddrsistemas',
            'dominio' => 'http://www.repuestoexpres.com',
            'address'  => 'Caracas, Venezuela',
            'rifLetter' => 'J',
            'rifNumber' => '22222222-8',
            // 'dominio' => 'http://www.repuestoexpres.com',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
        // id 5
        DB::table('comercios')->insert([
            'area_id' => '1',
            'user_id' => '5',
            'keyword' => 'coffetown',
            'name' => 'Coffetown',
            'avatar' => 'logo_coffetown.jpg',
            'banner' => 'logo_cafetown.png',
            'contactcellphone' => '04162222222',
            'contactphone'  => '0212-222-22-22',
            'horario'  => 'Lunes a Domingo hora: 6:30 am a 8:00 pm',
            'email'  => 'panaderiaexpreso@gmail.com',
            'youtube'  => 'https://www.youtube.com/@ddrsistemas',
            'twitter'  => 'https://www.youtube.com/@ddrsistemas',
            'facebook'  => 'https://www.youtube.com/@ddrsistemas',
            'dominio' => 'http://www.repuestoexpres.com',
            'instagram' => 'https://www.instagram.com/coffeetown.ccs/?hl=es',
            'address'  => 'Caracas, Venezuela',
            'rifLetter' => 'J',
            'rifNumber' => '22222222-8',
            // 'dominio' => 'http://www.repuestoexpres.com',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        // id 6
        DB::table('comercios')->insert([
            'area_id' => '1',
            'user_id' => '6',
            'keyword' => 'titanium',
            'name' => 'Titanium',
            'avatar' => 'logo_titanium.jpg',
            'banner' => 'logos_panaderiatitanium_01.png',
            'contactcellphone' => '04162222222',
            'contactphone'  => '0212-222-22-22',
            'horario'  => 'Lunes a Domingo hora: 6:30 am a 8:00 pm',
            'email'  => 'panaderiaexpreso@gmail.com',
            'youtube'  => 'https://www.youtube.com/@ddrsistemas',
            'twitter'  => 'https://www.youtube.com/@ddrsistemas',
            'facebook'  => 'https://www.youtube.com/@ddrsistemas',
            'dominio' => 'http://www.repuestoexpres.com',
            'instagram' => 'https://www.instagram.com/coffeetown.ccs/?hl=es',
            'address'  => 'Caracas, Venezuela',
            'rifLetter' => 'J',
            'rifNumber' => '22222222-8',
            // 'dominio' => 'http://www.repuestoexpres.com',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        // id 7
        DB::table('comercios')->insert([
            'area_id' => '1',
            'user_id' => '7',
            'keyword' => 'candelaria',
            'name' => 'Panaderia Candelaria',
            'avatar' => 'logo_candelaria.jpg',
            'banner' => 'logos_panaderiatitanium_01.png',
            'contactcellphone' => '04162222222',
            'contactphone'  => '0212-222-22-22',
            'horario'  => 'Lunes a Domingo hora: 6:30 am a 8:00 pm',
            'email'  => 'panaderiaexpreso@gmail.com',
            'youtube'  => 'https://www.youtube.com/@ddrsistemas',
            'twitter'  => 'https://www.youtube.com/@ddrsistemas',
            'facebook'  => 'https://www.youtube.com/@ddrsistemas',
            'dominio' => 'http://www.repuestoexpres.com',
            'instagram' => 'https://www.instagram.com/coffeetown.ccs/?hl=es',
            'address'  => 'Caracas, Venezuela',
            'rifLetter' => 'J',
            'rifNumber' => '22222222-8',
            // 'dominio' => 'http://www.repuestoexpres.com',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

         // id 8
         DB::table('comercios')->insert([
            'area_id' => '1',
            'user_id' => '8',
            'keyword' => 'gama',
            'name' => 'Gama',
            'avatar' => 'logo_gama.jpg',
            'banner' => 'logos_panaderiatitanium_01.png',
            'contactcellphone' => '04162222222',
            'contactphone'  => '0212-222-22-22',
            'horario'  => 'Lunes a Domingo hora: 6:30 am a 8:00 pm',
            'email'  => 'panaderiaexpreso@gmail.com',
            'youtube'  => 'https://www.youtube.com/@ddrsistemas',
            'twitter'  => 'https://www.youtube.com/@ddrsistemas',
            'facebook'  => 'https://www.youtube.com/@ddrsistemas',
            'dominio' => 'http://www.repuestoexpres.com',
            'instagram' => 'https://www.instagram.com/coffeetown.ccs/?hl=es',
            'address'  => 'Caracas, Venezuela',
            'rifLetter' => 'J',
            'rifNumber' => '22222222-8',
            // 'dominio' => 'http://www.repuestoexpres.com',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        // id 9
        DB::table('comercios')->insert([
            'area_id' => '1',
            'user_id' => '9',
            'keyword' => 'rio',
            'name' => 'Rio',
            'avatar' => 'logo_rio.jpg',
            'banner' => 'logos_panaderiatitanium_01.png',
            'contactcellphone' => '04162222222',
            'contactphone'  => '0212-222-22-22',
            'horario'  => 'Lunes a Domingo hora: 6:30 am a 8:00 pm',
            'email'  => 'panaderiaexpreso@gmail.com',
            'youtube'  => 'https://www.youtube.com/@ddrsistemas',
            'twitter'  => 'https://www.youtube.com/@ddrsistemas',
            'facebook'  => 'https://www.youtube.com/@ddrsistemas',
            'dominio' => 'http://www.repuestoexpres.com',
            'instagram' => 'https://www.instagram.com/coffeetown.ccs/?hl=es',
            'address'  => 'Caracas, Venezuela',
            'rifLetter' => 'J',
            'rifNumber' => '22222222-8',
            // 'dominio' => 'http://www.repuestoexpres.com',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        // id 10
        DB::table('comercios')->insert([
            'area_id' => '1',
            'user_id' => '10',
            'keyword' => 'vollmerbakery',
            'name' => 'Vollmer Bakery',
            'avatar' => 'logo_vollmer.jpg',
            'banner' => 'logo_vollmer.jpg',
            'contactcellphone' => '04162222222',
            'contactphone'  => '0212-222-22-22',
            'horario'  => 'Lunes a Domingo hora: 6:30 am a 8:00 pm',
            'email'  => 'panaderiaexpreso@gmail.com',
            'youtube'  => 'https://www.youtube.com/@ddrsistemas',
            'twitter'  => 'https://www.youtube.com/@ddrsistemas',
            'facebook'  => 'https://www.youtube.com/@ddrsistemas',
            'dominio' => 'http://www.repuestoexpres.com',
            'instagram' => 'https://www.instagram.com/coffeetown.ccs/?hl=es',
            'address'  => 'Caracas, Venezuela',
            'rifLetter' => 'J',
            'rifNumber' => '22222222-8',
            // 'dominio' => 'http://www.repuestoexpres.com',
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
        
    }
}

        
        
        
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // expreso id=2  prod = 1
        DB::table('products')->insert([
            'code_lote' => 'P0001',
            'code' => 'P0001',
            'name' => 'Pan de Jamón de 650 gramos',
            'description' => 'Pan de Jamón de 650 gramos',
            'details1' => 'Ofertas Pan de Jamón de 650 gramos',
            'image_path1' => 'pan_expreso.jpg',
            'manufacturer_id' => '1', //marca
            'brand_id' => 1, //marca
            'container_id' => 1, //envase
            'currency' => '$', //moneda
            'price1' => 8.0, //precio al detal
            'profit_price' => 12, // porcentaje de ganancia
            'price_mayor' => 1, //precio al mayor
            'profit_mayor' => 12, // porcentaje de ganancia
            'price_offer' => 1, //precio de oferta
            'profit_offer' => 12, // porcentaje de ganancia
            'price_divisa' => 41, //precio del dolar cuando se adquirió
            'in_delivery' => '1', 
            'stock_min' => 10,
            'stock_max' => 100,
            'stock' => 50, // cant en almacen
            'area_id' => 1,
            'user_id' => 2,
            'comercio_id' => 2,
            'category_id' => 2,
            'subcategory_id' => 10,
            'supplier_id' => 1, //proveedor
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
        // expreso id=2  prod = 2
        DB::table('products')->insert([
            'code_lote' => 'C0002',
            'code' => 'C0002',
            'name' => 'EXPRESO Combo navideño',
            'description' => 'Pan de Jamón de 650 gramos + Cocacola 1,5 litro',
            'details1' => 'Ofertas Pan de Jamón de 650 gramos',
            'image_path1' => 'combo_expreso.jpg',
            'manufacturer_id' => '1', //marca
            'brand_id' => 1, //marca
            'container_id' => 1, //envase
            'currency' => '$', //moneda
            'price1' => 10.0, //precio al detal
            'profit_price' => 12, // porcentaje de ganancia
            'price_mayor' => 1, //precio al mayor
            'profit_mayor' => 12, // porcentaje de ganancia
            'price_offer' => 1, //precio de oferta
            'profit_offer' => 12, // porcentaje de ganancia
            'price_divisa' => 41, //precio del dolar cuando se adquirió
            'in_delivery' => '1', 
            'in_delivery' => '1', 
            'in_combo' => '1', 
            'stock_min' => 10,
            'stock_max' => 100,
            'stock' => 50, // cant en almacen
            'area_id' => 1,
            'user_id' => 2,
            'comercio_id' => 2,
            'category_id' => 2,
            'subcategory_id' => 10,
            'supplier_id' => 1, //proveedor
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        // panaderiadoralta id= 3 prod=3
        DB::table('products')->insert([
            'code_lote' => 'P0001',
            'code' => 'P0001',
            'name' => 'Pan de Jamón de 650 gramos',
            'description' => 'Pan de Jamón de 650 gramos',
            'image_path1' => 'pan_doralta.jpg',
            'manufacturer_id' => '1', //marca
            'brand_id' => 1, //marca
            'container_id' => 1, //envase
            'currency' => '$', //moneda
            'price1' => 7.0, //precio al detal
            'profit_price' => 12, // porcentaje de ganancia
            'price_mayor' => 1, //precio al mayor
            'profit_mayor' => 12, // porcentaje de ganancia
            'price_offer' => 1, //precio de oferta
            'profit_offer' => 12, // porcentaje de ganancia
            'price_divisa' => 41, //precio del dolar cuando se adquirió
            'in_delivery' => '1', 
            'stock_min' => 10,
            'stock_max' => 100,
            'stock' => 50, // cant en almacen
            'area_id' => 1,
            'user_id' => 3,
            'comercio_id' => 3,
            'category_id' => 2,
            'subcategory_id' => 10,
            'supplier_id' => 1, //proveedor
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        // panaderiadoralta id= 3 prod=4
        DB::table('products')->insert([
            'code_lote' => 'C0002',
            'code' => 'C0002',
            'name' => 'DORALTA Combo navideño + Cocacola 1,5 litro',
            'description' => 'Pan de Jamón de 650 gramos',
            'image_path1' => 'combo_doralta.jpg',
            'manufacturer_id' => '1', //marca
            'brand_id' => 1, //marca
            'container_id' => 1, //envase
            'currency' => '$', //moneda
            'price1' => 9.0, //precio al detal
            'profit_price' => 12, // porcentaje de ganancia
            'price_mayor' => 1, //precio al mayor
            'profit_mayor' => 12, // porcentaje de ganancia
            'price_offer' => 1, //precio de oferta
            'profit_offer' => 12, // porcentaje de ganancia
            'price_divisa' => 41, //precio del dolar cuando se adquirió
            'in_delivery' => '1', 
            'in_delivery' => '1', 
            'in_combo' => '1', 
            'stock_min' => 10,
            'stock_max' => 100,
            'stock' => 50, // cant en almacen
            'area_id' => 1,
            'user_id' => 3,
            'comercio_id' => 3,
            'category_id' => 2,
            'subcategory_id' => 10,
            'supplier_id' => 1, //proveedor
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        // Panaderiaolandely id= 4 prod=5
        DB::table('products')->insert([
            'code_lote' => 'P0002',
            'code' => 'P0002',
            'name' => 'Pan de Jamón de 1000 gramos',
            'description' => 'Pan de Jamón de 1000 gramos',
            'image_path1' => 'pan_olandely.png',
            'manufacturer_id' => '1', //marca
            'brand_id' => 1, //marca
            'container_id' => 1, //envase
            'currency' => '$', //moneda
            'price1' => 10.0, //precio al detal
            'profit_price' => 12, // porcentaje de ganancia
            'price_mayor' => 1, //precio al mayor
            'profit_mayor' => 12, // porcentaje de ganancia
            'price_offer' => 1, //precio de oferta
            'profit_offer' => 12, // porcentaje de ganancia
            'price_divisa' => 41, //precio del dolar cuando se adquirió
            'in_delivery' => '1', 
            'stock_min' => 10,
            'stock_max' => 100,
            'stock' => 50, // cant en almacen
            'area_id' => 1,
            'user_id' => 4,
            'comercio_id' => 4,
            'category_id' => 2,
            'subcategory_id' => 10,
            'supplier_id' => 1, //proveedor
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
        // Panaderiaolandely id= 4 prod=6
        DB::table('products')->insert([
            'code_lote' => 'C0002',
            'code' => 'C0002',
            'name' => 'OLANDELY Combo navideño',
            'description' => 'Pan de Jamón de 1000 gramos + Cocacola 1,5 litro',
            'image_path1' => 'combo_olandely.jpg',
            'manufacturer_id' => '1', //marca
            'brand_id' => 1, //marca
            'container_id' => 1, //envase
            'currency' => '$', //moneda
            'price1' => 12.0, //precio al detal
            'profit_price' => 12, // porcentaje de ganancia
            'price_mayor' => 1, //precio al mayor
            'profit_mayor' => 12, // porcentaje de ganancia
            'price_offer' => 1, //precio de oferta
            'profit_offer' => 12, // porcentaje de ganancia
            'price_divisa' => 41, //precio del dolar cuando se adquirió
            'in_delivery' => '1', 
            'in_delivery' => '1', 
            'in_combo' => '1', 
            'stock_min' => 10,
            'stock_max' => 100,
            'stock' => 50, // cant en almacen
            'area_id' => 1,
            'user_id' => 4,
            'comercio_id' => 4,
            'category_id' => 2,
            'subcategory_id' => 10,
            'supplier_id' => 1, //proveedor
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        // cafetown id= 5 prod=7
        DB::table('products')->insert([
            'code_lote' => 'P0004',
            'code' => 'P0004',
            'name' => 'Pan de Jamón  de 1000 gramos',
            'description' => 'Pan de Jamón de 1000 gramos',
            'image_path1' => 'pan_coffetown.jpg',
            'manufacturer_id' => '1', //marca
            'brand_id' => 1, //marca
            'container_id' => 1, //envase
            'currency' => '$', //moneda
            'price1' => 12.0, //precio al detal
            'profit_price' => 12, // porcentaje de ganancia
            'price_mayor' => 1, //precio al mayor
            'profit_mayor' => 12, // porcentaje de ganancia
            'price_offer' => 1, //precio de oferta
            'profit_offer' => 12, // porcentaje de ganancia
            'price_divisa' => 41, //precio del dolar cuando se adquirió
            'in_delivery' => '1', 
            'stock_min' => 10,
            'stock_max' => 100,
            'stock' => 50, // cant en almacen
            'area_id' => 1,
            'user_id' => 5,
            'comercio_id' => 5,
            'category_id' => 2,
            'subcategory_id' => 10,
            'supplier_id' => 1, //proveedor
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
        // cafetown id= 5 prod=8
        DB::table('products')->insert([
            'code_lote' => 'C0004',
            'code' => 'C0004',
            'name' => 'Coffetown Combo navideño + Cocacola 1,5 litro',
            'description' => 'Pan de Jamón de 1000 gramos',
            'image_path1' => 'combo_coffetown.jpg',
            'manufacturer_id' => '1', //marca
            'brand_id' => 1, //marca
            'container_id' => 1, //envase
            'currency' => '$', //moneda
            'price1' => 14.0, //precio al detal
            'profit_price' => 12, // porcentaje de ganancia
            'price_mayor' => 1, //precio al mayor
            'profit_mayor' => 12, // porcentaje de ganancia
            'price_offer' => 1, //precio de oferta
            'profit_offer' => 12, // porcentaje de ganancia
            'price_divisa' => 41, //precio del dolar cuando se adquirió
            'in_delivery' => '1', 
            'in_delivery' => '1', 
            'in_combo' => '1', 
            'stock_min' => 10,
            'stock_max' => 100,
            'stock' => 50, // cant en almacen
            'area_id' => 1,
            'user_id' => 5,
            'comercio_id' => 5,
            'category_id' => 2,
            'subcategory_id' => 10,
            'supplier_id' => 1, //proveedor
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        // titanium id= 6 prod= 9
        DB::table('products')->insert([
            'code_lote' => 'P0005',
            'code' => 'P0005',
            'name' => 'Pan de 700 gramos',
            'description' => 'Pan de 700 gramos',
            'image_path1' => 'pan_titanium.jpg',
            'manufacturer_id' => '1', //marca
            'brand_id' => 1, //marca
            'container_id' => 1, //envase
            'currency' => '$', //moneda
            'price1' => 9.0, //precio al detal
            'profit_price' => 12, // porcentaje de ganancia
            'price_mayor' => 1, //precio al mayor
            'profit_mayor' => 12, // porcentaje de ganancia
            'price_offer' => 1, //precio de oferta
            'profit_offer' => 12, // porcentaje de ganancia
            'price_divisa' => 41, //precio del dolar cuando se adquirió
            'in_delivery' => '1', 
            'stock_min' => 10,
            'stock_max' => 100,
            'stock' => 50, // cant en almacen
            'area_id' => 1,
            'user_id' => 6,
            'comercio_id' => 6,
            'category_id' => 2,
            'subcategory_id' => 10,
            'supplier_id' => 1, //proveedor
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
        // titanium id= 6 prod= 10
        DB::table('products')->insert([
            'code_lote' => 'C0005',
            'code' => 'C0005',
            'name' => 'Titanium Combo navideño + Cocacola 1,5 litro',
            'description' => 'Pan de 700 gramos',
            'image_path1' => 'combo_titanium.jpg',
            'manufacturer_id' => '1', //marca
            'brand_id' => 1, //marca
            'container_id' => 1, //envase
            'currency' => '$', //moneda
            'price1' => 11.0, //precio al detal
            'profit_price' => 12, // porcentaje de ganancia
            'price_mayor' => 1, //precio al mayor
            'profit_mayor' => 12, // porcentaje de ganancia
            'price_offer' => 1, //precio de oferta
            'profit_offer' => 12, // porcentaje de ganancia
            'price_divisa' => 41, //precio del dolar cuando se adquirió
            'in_delivery' => '1', 
            'in_delivery' => '1', 
            'in_combo' => '1', 
            'stock_min' => 10,
            'stock_max' => 100,
            'stock' => 50, // cant en almacen
            'area_id' => 1,
            'user_id' => 6,
            'comercio_id' => 6,
            'category_id' => 2,
            'subcategory_id' => 10,
            'supplier_id' => 1, //proveedor
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        // camdelaria id= 7 prod=11
        DB::table('products')->insert([
            'code_lote' => 'P0005',
            'code' => 'P0005',
            'name' => 'Pan de 700 gramos',
            'description' => 'Pan de 700 gramos ',
            'image_path1' => 'pan_candelaria.jpg',
            'manufacturer_id' => '1', //marca
            'brand_id' => 1, //marca
            'container_id' => 1, //envase
            'currency' => '$', //moneda
            'price1' => 9.0, //precio al detal
            'profit_price' => 12, // porcentaje de ganancia
            'price_mayor' => 1, //precio al mayor
            'profit_mayor' => 12, // porcentaje de ganancia
            'price_offer' => 1, //precio de oferta
            'profit_offer' => 12, // porcentaje de ganancia
            'price_divisa' => 41, //precio del dolar cuando se adquirió
            'in_delivery' => '1', 
            'stock_min' => 10,
            'stock_max' => 100,
            'stock' => 50, // cant en almacen
            'area_id' => 1,
            'user_id' => 7,
            'comercio_id' => 7,
            'category_id' => 2,
            'subcategory_id' => 10,
            'supplier_id' => 1, //proveedor
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);
        // camdelaria id= 7 prod=12
        DB::table('products')->insert([
            'code_lote' => 'C0005',
            'code' => 'C0005',
            'name' => 'Candelaria Combo navideño + Cocacola 1,5 litro',
            'description' => 'Pan de 700 gramos',
            'image_path1' => 'combo_candelaria.jpg',
            'manufacturer_id' => '1', //marca
            'brand_id' => 1, //marca
            'container_id' => 1, //envase
            'currency' => '$', //moneda
            'price1' => 11.0, //precio al detal
            'profit_price' => 12, // porcentaje de ganancia
            'price_mayor' => 1, //precio al mayor
            'profit_mayor' => 12, // porcentaje de ganancia
            'price_offer' => 1, //precio de oferta
            'profit_offer' => 12, // porcentaje de ganancia
            'price_divisa' => 41, //precio del dolar cuando se adquirió
            'in_delivery' => '1', 
            'in_delivery' => '1', 
            'in_combo' => '1', 
            'stock_min' => 10,
            'stock_max' => 100,
            'stock' => 50, // cant en almacen
            'area_id' => 1,
            'user_id' => 7,
            'comercio_id' => 7,
            'category_id' => 2,
            'subcategory_id' => 10,
            'supplier_id' => 1, //proveedor
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        // gama id= 8 prod=13
        DB::table('products')->insert([
            'code_lote' => 'C0005',
            'code' => 'C0005',
            'name' => 'Pan de Jamon',
            'description' => 'Pan de 700 gramos',
            'image_path1' => 'pan_gama.jpg',
            'manufacturer_id' => '1', //marca
            'brand_id' => 1, //marca
            'container_id' => 1, //envase
            'currency' => '$', //moneda
            'price1' => 11.0, //precio al detal
            'profit_price' => 12, // porcentaje de ganancia
            'price_mayor' => 1, //precio al mayor
            'profit_mayor' => 12, // porcentaje de ganancia
            'price_offer' => 1, //precio de oferta
            'profit_offer' => 12, // porcentaje de ganancia
            'price_divisa' => 41, //precio del dolar cuando se adquirió
            'in_delivery' => '1', 
            'in_delivery' => '1', 
            'in_combo' => '1', 
            'stock_min' => 10,
            'stock_max' => 100,
            'stock' => 50, // cant en almacen
            'area_id' => 1,
            'user_id' => 8,
            'comercio_id' => 8,
            'category_id' => 2,
            'subcategory_id' => 10,
            'supplier_id' => 1, //proveedor
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

        // gama id= 8 prod=14
        DB::table('products')->insert([
            'code_lote' => 'C0005',
            'code' => 'C0005',
            'name' => 'Gama Combo navideño',
            'description' => 'Pan de 700 gramos + Cocacola 1,5 litro',
            'image_path1' => 'combo_gama.jpg',
            'manufacturer_id' => '1', //marca
            'brand_id' => 1, //marca
            'container_id' => 1, //envase
            'currency' => '$', //moneda
            'price1' => 14.95, //precio al detal
            'profit_price' => 12, // porcentaje de ganancia
            'price_mayor' => 1, //precio al mayor
            'profit_mayor' => 12, // porcentaje de ganancia
            'price_offer' => 1, //precio de oferta
            'profit_offer' => 12, // porcentaje de ganancia
            'price_divisa' => 41, //precio del dolar cuando se adquirió
            'in_delivery' => '1', 
            'in_delivery' => '1', 
            'in_combo' => '1', 
            'stock_min' => 10,
            'stock_max' => 100,
            'stock' => 50, // cant en almacen
            'area_id' => 1,
            'user_id' => 8,
            'comercio_id' => 8,
            'category_id' => 2,
            'subcategory_id' => 10,
            'supplier_id' => 1, //proveedor
            'userCreated_at' => 1,
            'userUpdated_at' => 1,
            'created_at' => '2022-05-16 12:20:36',
            'updated_at' => '2022-05-16 12:20:36'
        ]);

    }
}






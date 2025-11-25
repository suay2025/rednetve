<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('id')
                ->on('areas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('user_id');
            $table->bigInteger('comercio_id');
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('subcategory_id')->nullable();
            $table->json('subcategories')->nullable();
            $table->bigInteger('supplier_id')->nullable(); //proveedor
            $table->string('code_lote')->nullable();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->bigInteger('manufacturer_id')->nullable();
            $table->bigInteger('brand_id')->nullable();
            $table->bigInteger('model_id')->nullable();
            $table->bigInteger('motor_id')->nullable();
            $table->string('avatar')->nullable();
            $table->string('image_path1')->nullable();
            $table->string('image_path2')->nullable();
            $table->string('image_path3')->nullable();
            $table->string('image_path4')->nullable();
            $table->string('video_path1')->nullable();
            $table->bigInteger('container_id')->nullable(); //envase
            $table->string('details1')->nullable();
            $table->string('details2')->nullable();
            $table->string('description')->nullable();
            $table->string('currency')->nullable();
            $table->decimal('price1',12, 2)->nullable();
            $table->decimal('price2',12, 2)->nullable();
            $table->decimal('profit_price',12,2)->nullable(); // porcentaje de ganancia
            $table->decimal('price_mayor',12,2)->nullable(); //precio al mayor
            $table->decimal('profit_mayor',12,2)->nullable(); // porcentaje de ganancia
            $table->decimal('price_offer',12,2)->nullable(); //precio de oferta
            $table->decimal('profit_offer',12,2)->nullable(); // porcentaje de ganancia
            $table->decimal('price_divisa',12,2)->nullable(); //precio del dolar cuando se adquirió
            $table->decimal('shipping_cost', 12,2)->nullable(); // costo de envio
            $table->decimal('stock_min',12,2)->nullable();
            $table->decimal('stock_max',12,2)->nullable();
            $table->decimal('stock')->nullable(); // cant en almacen
            
            $table->bigInteger('pack_products_id')->nullable();
            $table->decimal('pack_price')->nullable();
            $table->string('tx_peso')->nullable();
            $table->string('tx_tamanio')->nullable();
            $table->string('tx_presentacion')->nullable();
            $table->string('tx_tamanio_carga')->nullable();
            $table->string('tx_tamanio_venta')->nullable();
            $table->string('tx_contornos')->nullable();
            $table->string('tx_contiene')->nullable();
            $table->date('fe_vencimiento')->nullable();
            $table->date('fe_expedicion')->nullable();

            $table->string('in_pickup')->nullable()->default('1'); // Si o No
            $table->string('in_delivery')->nullable()->default('1'); // Si o No
            $table->string('in_envio_nacional')->nullable()->default('0'); // Si o No
            $table->string('in_envio_gratis')->nullable()->default('0');
            
            $table->string('madein')->nullable();
            $table->string('in_pedido')->nullable();
            $table->string('tx_adicionales')->nullable();
            $table->string('tx_alergenos')->nullable();
            
            $table->string('in_offer')->nullable()->default('0');
            $table->string('tx_datos_vencimiento')->nullable();
            $table->string('tx_valores_nutricionales')->nullable();
            $table->string('tx_conservacion')->nullable();
            $table->string('tx_recomendacion_consumo')->nullable();
            $table->string('tx_envase_embalaje')->nullable();
            $table->string('in_fragil')->nullable()->default('0');
            $table->string('in_por_encargo')->nullable()->default('0');
            $table->string('in_olor_fuerte')->nullable()->default('0');
            $table->integer('ca_valoracion')->nullable();
            $table->string('tx_vencimiento')->nullable();
            $table->string('in_valido')->nullable()->default('1');
            $table->string('in_combo')->nullable()->default('0');
            $table->bigInteger('userCreated_at');
            $table->bigInteger('userUpdated_at');
            $table->timestamps();
        });
    }

    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

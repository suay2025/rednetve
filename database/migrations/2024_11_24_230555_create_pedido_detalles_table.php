<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_detalles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pedido_id');
            $table->string('nropedido');
            $table->bigInteger('comercio_id');
            $table->bigInteger('user_id');
            $table->bigInteger('product_id');
            $table->string('name');
            $table->decimal('price1', 12, 2);
            $table->decimal('quantity', 12, 2);
            $table->string('image')->nullable();
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
        Schema::dropIfExists('pedido_detalles');
    }
}

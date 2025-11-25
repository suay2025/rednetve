<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoTemporalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido_temporals', function (Blueprint $table) {
            $table->id();
            $table->string('nropedido');
            $table->string('reference')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('comercio_id');
            $table->bigInteger('user_id');
            $table->decimal('coste', 12, 2);
            $table->decimal('costeenvio', 12, 2)->nullable();
            $table->string('currency')->default('1'); // 1 bs 2 $
            $table->string('metodo')->nullable(); // 1 bs 2 $
            $table->string('in_delivery')->default('0');
            $table->boolean('confirmed')->default('0');
            $table->string('metodoentrega')->nullable();
            //pickup
            $table->bigInteger('centrodistribucion_id')->nullable();
            $table->string('contactphone')->nullable();
            $table->string('horario')->nullable();
            //shipping envio
            $table->string('shipping')->nullable();
            $table->string('identificationNac')->nullable();
            $table->string('identificationNumber')->nullable();
            $table->string('names')->nullable();
            $table->string('surnames')->nullable();
            $table->string('cellphonecode')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('address')->nullable();
            $table->string('country_id')->nullable();
            $table->string('state_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('deliveryarea_id')->nullable();
            $table->string('deliveryarea')->nullable();
            $table->bigInteger('userdelivery_id')->nullable();
            $table->string('pedidoentregado')->nullable();
            $table->text('valoracionpedido')->nullable();
            $table->text('valoraciondelivery')->nullable();
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
        Schema::dropIfExists('pedido_temporals');
    }
}

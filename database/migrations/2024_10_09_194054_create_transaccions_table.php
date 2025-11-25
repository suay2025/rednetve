<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaccions', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('user_id');
            $table->bigInteger('comercio_id');
            $table->bigInteger('cliente_id');
            $table->string('paymentId')->nullable();
            $table->string('codigoFactura')->nullable();
            $table->string('nropedido')->nullable();
            $table->string('metodo')->nullable();
            $table->string('currency')->nullable();
            $table->string('banco')->nullable();
            $table->string('codigo')->nullable();
            $table->string('codigoBO')->nullable();
            $table->string('reference')->nullable(); //Pedido
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('email')->nullable();
            $table->string('emailO')->nullable();
            $table->string('identificationNac')->nullable();
            $table->string('identificationNumber')->nullable();
            $table->string('cellphonecode')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('rifLetter')->nullable();
            $table->string('rifNumber')->nullable();
            $table->string('fechaPago')->nullable();
            $table->decimal('amount', 12, 2)->nullable();
            $table->string('status')->nullable()->default('notconfirmed');
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
        Schema::dropIfExists('transaccions');
    }
}

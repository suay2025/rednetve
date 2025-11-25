<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_users', function (Blueprint $table) {
            $table->id();
            $table->string('nroTicket');
            $table->bigInteger('user_id');
            $table->bigInteger('userMikrotik_id');
            $table->string('server');
            $table->string('user');
            $table->string('password');
            $table->string('profile');
            $table->string('prefijo');
            $table->string('monto');
            $table->string('nrorouter');
            $table->string('status')->default('noactivo');
            $table->date('fechaVenta')->nullable();
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
        Schema::dropIfExists('ticket_users');
    }
}

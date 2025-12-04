<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMikrotiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_mikrotiks', function (Blueprint $table) {
            $table->id();
            $table->string('mikrotik_id')->nullable();
            $table->string('server')->nullable();
            $table->string('name')->nullable();
            $table->string('password')->nullable();
            $table->string('address')->nullable();
            $table->string('macaddress')->nullable();
            $table->string('profile')->nullable();
            $table->string('routes')->nullable();
            $table->string('email')->nullable();
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('user_mikrotiks');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComerciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comercios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('area_id');
            $table->foreign('area_id')->references('id')
                ->on('areas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('user_id');
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('banner')->nullable();
            $table->string('keyword')->unique();
            $table->string('dominio')->nullable();
            $table->string('contactcellphone')->nullable();
            $table->string('contactphone')->nullable();
            $table->string('msgcontact')->nullable();
            $table->string('horario')->nullable();
            $table->string('email')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('instagram')->nullable();
            $table->text('address')->nullable();
            $table->text('rifLetter')->nullable();
            $table->text('rifNumber')->nullable();
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
        Schema::dropIfExists('comercios');
    }
}

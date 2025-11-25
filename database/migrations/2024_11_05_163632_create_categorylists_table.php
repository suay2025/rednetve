<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorylists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('comercio_id');
            $table->foreign('comercio_id')->references('id')
                ->on('comercios')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('avatar')->nullable();
            $table->string('itemMenu')->default('0');
            $table->integer('posicionMenu')->nullable('0');        
            $table->bigInteger('nivel')->nullable()->default(0);
            $table->bigInteger('point_id')->nullable()->default(0);
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
        Schema::dropIfExists('categorylists');
    }
}

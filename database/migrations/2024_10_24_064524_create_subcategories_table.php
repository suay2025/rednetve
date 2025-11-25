<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subcategories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('comercio_id');
            $table->bigInteger('category_id');
            $table->string('name')->nullable(); 
            $table->string('description')->nullable();
            $table->string('avatar')->nullable(); 
            $table->string('itemMenu')->default('0');
            $table->string('itemSubmenu')->default('0');
            $table->integer('posicionMenu')->nullable()->default('0');;  
            $table->integer('posicionSubmenu')->nullable()->default('0');; 
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
        Schema::dropIfExists('subcategories');
    }
}

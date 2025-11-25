<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notificacions', function (Blueprint $table) {
            $table->id();
            $table->string('medio')->nullable();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->integer('adjunto')->nullable()->default(0);
            $table->string('file')->nullable();
            $table->integer('nrosends')->nullable()->default(0);
            $table->bigInteger('comercio_id')->nullable();            
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
        Schema::dropIfExists('notificacions');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingComerciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_comercios', function (Blueprint $table) {
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
            $table->string('site_name')->nullable()->default(null);
            $table->string('site_email')->nullable()->default(null);
            $table->string('site_title')->nullable()->default(null);
            $table->string('footer_text')->nullable()->default(null);
            $table->boolean('sidebar_collapse')->default(false);
            $table->boolean('in_cellphonecontact')->default(true);
            $table->boolean('in_sliderprincipal')->default(true);
            $table->boolean('in_marcasproductos')->default(true);
            
            $table->string('currency')->nullable()->default('$');
            $table->string('api_bcv')->nullable()->default('NO');
            $table->string('in_impuesto')->nullable()->default('SI');
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
        Schema::dropIfExists('setting_comercios');
    }
}

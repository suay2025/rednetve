<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserToPagomovilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagomovils', function (Blueprint $table) {
            $table->string('user')->nullable();
            $table->string('plan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagomovils', function (Blueprint $table) {
            $table->dropColumn('user');
            $table->dropColumn('plan');
        });
    }
}

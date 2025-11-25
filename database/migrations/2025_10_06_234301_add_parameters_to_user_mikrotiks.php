<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParametersToUserMikrotiks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_mikrotiks', function (Blueprint $table) {
            $table->string('limitUptime')->nullable();
            $table->string('limitBytesIn')->nullable();
            $table->string('limitBytesOut')->nullable();
            $table->string('limitBytesTotal')->nullable();
            $table->string('uptime')->nullable();
            $table->string('bytesIn')->nullable();
            $table->string('packetsIn')->nullable();
            $table->string('bytesOut')->nullable();
            $table->string('packetsOut')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_mikrotiks', function (Blueprint $table) {
            $table->dropColumn('limitUptime');
            $table->dropColumn('limitBytesIn');
            $table->dropColumn('limitBytesOut');
            $table->dropColumn('limitBytesTotal');
            $table->dropColumn('uptime');
            $table->dropColumn('bytesIn');
            $table->dropColumn('packetsIn');
            $table->dropColumn('bytesOut');
            $table->dropColumn('packetsOut');
        });
    }
}

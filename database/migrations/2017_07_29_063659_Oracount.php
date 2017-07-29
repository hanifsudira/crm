<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Oracount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oracount', function (Blueprint $table) {
            $table->increments('id');
            $table->string('STATUS_ORDER',50)->nullable();
            $table->string('STATUS_FULFILLMENT',50)->nullable();
            $table->string('MILESTONE',50)->nullable();
            $table->string('JUMLAH',10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oracount');
    }
}

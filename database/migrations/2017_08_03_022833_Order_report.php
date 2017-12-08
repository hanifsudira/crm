<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_report', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ORDER_NUM',50)->nullable();
            $table->string('STATUS',50)->nullable();
            $table->string('ACC_NAS',50)->nullable();
            $table->string('NIPNAS',50)->nullable();
            $table->string('lastupdate',50)->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_report');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OracleOne extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oraexcel', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ORDER_NUM',50)->nullable();
            $table->string('ORDER_SUBTYPE',50)->nullable();
            $table->string('OH_STATUS',50)->nullable();
            $table->string('MOLI_ROW_ID',50)->nullable();
            $table->string('MOLI_CREATED_DT',50)->nullable();
            $table->string('MOLI_LAST_UPDATED_DT',50)->nullable();
            $table->string('MOLI_PRODUCT_NAME',50)->nullable();
            $table->string('MOLI_STATUS',50)->nullable();
            $table->string('MOLI_FULFILLMENT_STATUS',50)->nullable();
            $table->string('MOLI_MILESTONE',50)->nullable();
            $table->string('MOLI_SERVICE_ID',50)->nullable();
            $table->string('MOLI_ASSET_INTEG_ID',50)->nullable();
            $table->string('MOLI_BILL_',50)->nullable();
            $table->string('MOLI_AGREE_NUM',50)->nullable();
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
        Schema::dropIfExists('oraexcel');
    }
}

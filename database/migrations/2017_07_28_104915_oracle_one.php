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
            $table->string('ORDER_NUM',30)->nullable();
            $table->string('ORDER_SUBTYPE',10)->nullable();
            $table->string('OH_STATUS',10)->nullable();
            $table->string('MOLI_ROW_ID',10)->nullable();
            $table->string('MOLI_CREATED_DT',10)->nullable();
            $table->string('MOLI_LAST_UPDATED_DT',10)->nullable();
            $table->string('MOLI_PRODUCT_NAME',10)->nullable();
            $table->string('MOLI_STATUS',10)->nullable();
            $table->string('MOLI_FULFILLMENT_STATUS',10)->nullable();
            $table->string('MOLI_MILESTONE',10)->nullable();
            $table->string('MOLI_SERVICE_ID',10)->nullable();
            $table->string('MOLI_ASSET_INTEG_ID',10)->nullable();
            $table->string('MOLI_BILL_',10)->nullable();
            $table->string('MOLI_AGREE_NUM',10)->nullable();
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

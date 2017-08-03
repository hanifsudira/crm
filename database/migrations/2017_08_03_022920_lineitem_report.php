<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LineitemReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lineitem_report', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ORDER#',50)->nullable();
            $table->string('REV',50)->nullable();
            $table->string('PRODUCT',50)->nullable();
            $table->string('OH_STATUS',50)->nullable();
            $table->string('LI_STATUS',50)->nullable();
            $table->string('MILESTONE',50)->nullable();
            $table->string('ORDER_SUBTYPE',50)->nullable();
            $table->string('CREATED_AT',50)->nullable();
            $table->string('FULFILL_STATUS',50)->nullable();
            $table->string('ACC_NAS',50)->nullable();
            $table->string('NIPNAS',50)->nullable();
            $table->string('SID_NUM',50)->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lineitem_report');
    }
}

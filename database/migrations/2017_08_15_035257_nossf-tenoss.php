<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NossfTenoss extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nossftenoss', function (Blueprint $table) {
            $table->increments('id');
            $table->string('STATUS_ORDER',50)->nullable();
            $table->string('STATUS_FULFILLMENT',50)->nullable();
            $table->string('EXTERNALID',50)->nullable();
            $table->string('PRODUCTNAME',50)->nullable();
            $table->string('ORDERTYPE',50)->nullable();
            $table->string('TSQ_STATE',50)->nullable();
            $table->string('TSQ_DESC',50)->nullable();
            $table->string('DELIVER_STATE',50)->nullable();
            $table->string('DELIVER_DESC',50)->nullable();
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
        Schema::dropIfExists('nossftenoss');
    }
}

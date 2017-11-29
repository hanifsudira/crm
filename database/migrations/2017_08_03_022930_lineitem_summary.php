<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LineitemSummary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lineitem_summary', function (Blueprint $table) {
            $table->increments('id');
            $table->string('OH_STATUS',50)->nullable();
            $table->string('LI_STATUS',50)->nullable();
            $table->string('MILESTONE',50)->nullable();
            $table->string('JUMLAH',50)->nullable();
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
        Schema::dropIfExists('lineitem_summary');
    }
}

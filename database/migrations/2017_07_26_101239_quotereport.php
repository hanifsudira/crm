<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Quotereport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('quote', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tanggal',10)->nullable();
            $table->string('inprogress',10)->nullable();
            $table->string('approvalprocess',10)->nullable();
            $table->string('acceptedbycustomer',10)->nullable();
            $table->string('orderplaced',10)->nullable();
            $table->string('cancelled',10)->nullable();
            $table->string('newtoday',10)->nullable();
            $table->string('totalquote',10)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote');
    }
}

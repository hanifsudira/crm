<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Crm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('crm', function (Blueprint $table) {
                $table->increments('id');
                $table->string('date',30)->nullable();
                $table->string('sumber',50)->nullable();
                $table->string('onsite_support',30)->nullable();
                $table->string('nama_user',50)->nullable();
                $table->string('nik_user',15)->nullable();
                $table->text('user_login')->nullable();
                $table->string('divisi',50)->nullable();
                $table->string('no_telp',50)->nullable();
                $table->string('no_quote',50)->nullable();
                $table->string('no_order',50)->nullable();
                $table->text('deskripsi_komplain')->nullable();
                $table->string('kategori',30)->nullable();
                $table->string('status',20)->nullable();
                $table->string('assignee',50)->nullable();
                $table->text('solusi')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('crm');
    }
}

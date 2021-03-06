<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTarifWilayahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarif_wilayahs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama')->nullable();
            $table->string('harga')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('user_input')->nullable();
            $table->integer('user_update')->nullable();
            $table->string('trash',1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tarif_wilayahs');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_transaksi')->nullable();
            $table->integer('id_menu')->nullable();
            $table->integer('harga')->nullable();
            $table->integer('jml')->nullable();
            $table->integer('sub_total')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('trash')->nullable();
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
        Schema::dropIfExists('detail_transaksis');
    }
}

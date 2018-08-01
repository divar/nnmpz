<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pelanggan')->nullable();
            $table->integer('id_alamat')->nullable();
            $table->integer('id_tarif_wilayah')->nullable();
            $table->integer('id_jalan')->nullable();
            $table->integer('id_jenis')->nullable();
            $table->integer('total_harga')->nullable();
            $table->integer('tarif_wilayah')->nullable();
            $table->integer('ppn')->nullable();
            $table->integer('pajak_kurir')->nullable();
            $table->boolean('flag_kurir')->nullable();
            $table->integer('id_kurir')->nullable();
            $table->string('no_kwitansi',100)->nullable();
            $table->string('penerima',100)->nullable();
            $table->integer('user_input')->nullable();
            $table->integer('user_update')->nullable();
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
        Schema::dropIfExists('transaksis');
    }
}

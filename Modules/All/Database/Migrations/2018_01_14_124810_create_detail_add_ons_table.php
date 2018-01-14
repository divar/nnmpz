<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailAddOnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_add_ons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_detail_transaksi')->nullable();
            $table->integer('id_add_on')->nullable();
            $table->integer('harga')->nullable();
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
        Schema::dropIfExists('detail_add_ons');
    }
}

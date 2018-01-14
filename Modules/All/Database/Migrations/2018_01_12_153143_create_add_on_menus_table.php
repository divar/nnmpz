<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddOnMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_on_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kategori')->nullable();
            $table->string('nama',100)->nullable();
            $table->integer('harga')->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('add_on_menus');
    }
}

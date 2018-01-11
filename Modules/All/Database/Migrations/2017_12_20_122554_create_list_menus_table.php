<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_kategori')->nullable();
            $table->string('nama_menu')->nullable();
            $table->integer('harga')->nullable();
            $table->text('keterangan')->nullable();
            $table->integer('id_size');
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
        Schema::dropIfExists('list_menus');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJenisMakananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_makanan', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nama')->nullable();
            $table->string('trash',1)->nullable();
            $table->integer('user_input')->nullable();
            $table->integer('user_update')->nullable();
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
        Schema::dropIfExists('jenis_makanan');
    }
}

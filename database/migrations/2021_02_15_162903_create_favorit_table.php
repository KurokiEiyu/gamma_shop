<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorit', function (Blueprint $table) {
            $table->increments('id_favorit');
            $table->integer('pembeli_id')->unsigned();
            $table->integer('produk_id')->unsigned();
            $table->timestamps();

            $table->foreign('pembeli_id')->references('id_pembeli')->on('pembeli')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('produk_id')->references('id_produk')->on('produk')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorit');
    }
}

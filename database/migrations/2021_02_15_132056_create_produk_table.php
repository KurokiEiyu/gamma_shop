<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('id_produk');
            $table->integer('pelapak_id')->unsigned();
            $table->integer('kategori_id')->unsigned();
            $table->string('nama_produk', 50);
            $table->text('deskripsi');
            $table->string('ukuran');
            $table->text('path_foto');
            $table->integer('harga');
            $table->tinyInteger('stok');
            $table->timestamps();

            $table->foreign('pelapak_id')->references('id_pelapak')->on('pelapak')->onUpdate('cascade')->onDelete('Cascade');
            $table->foreign('kategori_id')->references('id_kategori')->on('kategori')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produk');
    }
}

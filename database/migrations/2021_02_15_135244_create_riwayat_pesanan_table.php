<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatPesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_pesanan', function (Blueprint $table) {
            $table->increments('id_riwayat_pesanan');
            $table->integer('transaksi_id')->unsigned();
            $table->integer('pembeli_id')->unsigned();
            $table->datetime('tgl_pesan');
            $table->tinyInteger('bintang')->nullable();
            $table->text('ulasan')->nullable();
            $table->timestamps();

            $table->foreign('transaksi_id')->references('id_transaksi')->on('transaksi')->onUpdate('cascade')->onDelete('no action');
            $table->foreign('pembeli_id')->references('id_pembeli')->on('pembeli')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_pesanan');
    }
}

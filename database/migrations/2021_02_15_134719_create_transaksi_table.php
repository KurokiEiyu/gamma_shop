<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id_transaksi');
            $table->integer('pembeli_id')->unsigned();
            $table->integer('pembayaran_id')->unsigned();
            $table->integer('order_detail_id')->unsigned();
            $table->timestamps();

            $table->foreign('pembeli_id')->references('id_pembeli')->on('pembeli')->onUpdate('cascade')->onDelete('no action');
            $table->foreign('pembayaran_id')->references('id_pembayaran')->on('pembayaran')->onUpdate('cascade')->onDelete('no action');
            $table->foreign('order_detail_id')->references('id_order_detail')->on('order_detail')->onUpdate('cascade')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}

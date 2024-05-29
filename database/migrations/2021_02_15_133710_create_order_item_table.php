<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->increments('id_order_item');
            $table->integer('produk_id')->unsigned();
            $table->integer('order_detail_id')->unsigned();
            $table->tinyInteger('qty');
            $table->string('ukuran');
            $table->enum('status', ['menunggu konfirmasi', 'dikemas', 'dikirim', 'penilaian', 'selesai']);
            $table->integer('fee_admin');
            $table->timestamps();

            $table->foreign('produk_id')->references('id_produk')->on('produk')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('order_detail_id')->references('id_order_detail')->on('order_detail')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_item');
    }
}

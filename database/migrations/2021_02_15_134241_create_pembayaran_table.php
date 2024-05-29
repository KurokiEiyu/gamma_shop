<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->increments('id_pembayaran');
            $table->integer('rekening_id')->unsigned()->nullable();
            $table->dateTime('tgl_bayar');
            $table->enum('metode_pembayaran', ['Cash on Delivery', 'Transfer Bank']);
            // $table->integer('ongkir');
            $table->integer('total_bayar');
            $table->integer('total_fee_admin');
            $table->string('bukti_transfer')->nullable();
            $table->timestamps();

            $table->foreign('rekening_id')->references('id_rekening')->on('rekening')->onDelete('no action')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}

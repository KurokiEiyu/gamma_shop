<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposit', function (Blueprint $table) {
            $table->increments('id_deposit');
            $table->integer('pelapak_id')->unsigned();
            $table->integer('rekening_id')->unsigned();
            $table->integer('nominal');
            $table->datetime('tgl_deposit');
            $table->string('bukti_transfer')->nullable();
            $table->enum('status', ['menunggu konfirmasi', 'diterima']);
            $table->timestamps();

            $table->foreign('pelapak_id')->references('id_pelapak')->on('pelapak')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('rekening_id')->references('id_rekening')->on('rekening')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposit');
    }
}

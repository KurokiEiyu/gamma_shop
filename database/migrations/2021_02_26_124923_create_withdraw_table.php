<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw', function (Blueprint $table) {
            $table->increments('id_withdraw');
            $table->integer('pelapak_id')->unsigned();
            $table->dateTime('tgl_withdraw');
            $table->integer('nominal');
            $table->string('nama_bank');
            $table->string('no_rek_tujuan');
            $table->string('atas_nama');
            $table->enum('status', ['menunggu konfirmasi', 'disetujui']);
            $table->timestamps();

            $table->foreign('pelapak_id')->references('id_pelapak')->on('pelapak')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdraw');
    }
}

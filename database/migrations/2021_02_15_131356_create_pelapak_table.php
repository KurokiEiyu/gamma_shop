<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelapakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelapak', function (Blueprint $table) {
            $table->increments('id_pelapak');
            $table->string('nama_toko', 50);
            $table->string('nama_pemilik', 50);
            $table->string('nama_pengguna', 30);
            $table->string('email', 30);
            $table->string('telepon', 15);
            $table->text('alamat');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('kata_sandi', 100);
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
        Schema::dropIfExists('pelapak');
    }
}

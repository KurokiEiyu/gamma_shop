<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_detail', function (Blueprint $table) {
            $table->increments('id_order_detail');
            $table->integer('pembeli_id')->unsigned();
            $table->text('alamat_penerima');
            $table->string('telepon_penerima', 15);
            $table->string('email_penerima', 30)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('order_detail');
    }
}

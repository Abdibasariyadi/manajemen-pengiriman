<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('paket_laundry_id')->unsigned();
            // $table->integer('harga');
            // $table->float('berat');
            $table->datetime('tanggal');
            $table->datetime('estimasi_selesai');
            $table->integer('harga_lines');
            $table->integer('diskon');
            $table->float('tax');
            $table->float('grand_total_amount');
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}

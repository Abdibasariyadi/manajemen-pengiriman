<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StatusPaket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paket_laundries', function (Blueprint $table) {
            $table->bigInteger('satuan_id')->unsigned()->nullable();

            $table->foreign('satuan_id')->references('id')->on('m_satuans')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paket_laundries', function (Blueprint $table) {
            //
        });
    }
}

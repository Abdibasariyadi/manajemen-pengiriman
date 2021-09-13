<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgerLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledger_lines', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ledger_id')->unsigned();
            $table->bigInteger('coa_id')->unsigned();
            $table->text('description')->nullable();
            $table->float('debit',15,2);
            $table->float('credit',15,2);
            $table->bigInteger('cabang_id')->unsigned();
            $table->datetime('tanggal');
            $table->timestamps();

            $table->foreign('cabang_id')->references('id')->on('m_cabangs')->onDelete('restrict');
            $table->foreign('coa_id')->references('id')->on('coas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ledger_lines');
    }
}

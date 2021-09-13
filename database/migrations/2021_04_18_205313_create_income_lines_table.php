<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomeLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_lines', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('income_id')->unsigned();
            $table->bigInteger('coa_id')->unsigned();
            $table->float('nominal',15,2);
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('coa_id')->references('id')->on('coas')->onDelete('restrict');
            $table->foreign('income_id')->references('id')->on('incomes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('income_lines');
    }
}

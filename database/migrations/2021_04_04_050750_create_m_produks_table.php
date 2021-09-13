<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->integer('harga')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('min_qty')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('order_tax')->nullable();
            $table->bigInteger('supplier_id')->unsigned()->nullable();
            $table->integer('is_active')->nullable();
            $table->text('keterangan')->nullable();
            $table->bigInteger('cabang_id')->unsigned()->nullable();
            $table->timestamps();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();

            $table->foreign('cabang_id')->references('id')->on('m_cabangs')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_produks');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoaCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coa_categories', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->integer('is_active');
            $table->bigInteger('cabang_id')->unsigned()->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('coa_categories');
    }
}

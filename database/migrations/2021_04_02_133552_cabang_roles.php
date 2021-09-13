<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CabangRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('m_roles', function (Blueprint $table) {
            $table->bigInteger('cabang_id')->unsigned()->nullable();

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
        Schema::table('m_roles', function (Blueprint $table) {
            //
        });
    }
}

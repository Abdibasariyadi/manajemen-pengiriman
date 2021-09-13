<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('company_name')->nullable();
            $table->string('no_npwp')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('email')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('kode_pos')->nullable();
            $table->bigInteger('cabang_id')->unsigned()->nullable();
            $table->integer('is_active')->nullable();
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
        Schema::dropIfExists('m_suppliers');
    }
}

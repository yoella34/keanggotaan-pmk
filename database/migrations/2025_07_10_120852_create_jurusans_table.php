<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
{
    Schema::create('jurusans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_jurusan'); // ← kolom ini harus ada
        $table->unsignedBigInteger('fakultas_id');
        $table->timestamps();

        $table->foreign('fakultas_id')->references('id')->on('fakultas')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jurusans');
    }
};

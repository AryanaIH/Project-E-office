<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('master_tujuan_proyeks', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tujuan');
            $table->string('nama_penerima');
            $table->string('instansi');
            $table->string('alamat');
            $table->integer('kontak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_tujuan_proyeks');
    }
};

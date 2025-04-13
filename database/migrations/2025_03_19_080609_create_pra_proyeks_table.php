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
{
    Schema::create('pra_proyeks', function (Blueprint $table) {
        $table->id();
        $table->string('nama_proyek');
        $table->string('pengusul');
        $table->date('tanggal_usulan');
        $table->string('status')->default('Menunggu Review');
        $table->text('catatan')->nullable();
        $table->timestamps();
    });
}

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pra_proyeks');
    }
};

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
        Schema::create('pra_proyeks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_proyek');
            $table->string('pengusul');
            $table->date('tanggal_usulan'); // nama 'tanggal' di form, tapi di blade pakai 'tanggal_usulan'
            $table->json('dokumen')->nullable(); // checkbox, jadi array JSON
            $table->enum('status_dokumen', ['ada', 'belum']);
            $table->enum('keterangan_status', ['lengkap', 'belum']);
            $table->enum('status', ['Menunggu Review', 'Disetujui', 'Ditolak'])->default('Menunggu Review');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pra_proyeks');
    }
};

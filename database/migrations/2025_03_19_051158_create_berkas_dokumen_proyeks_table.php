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
        Schema::create('berkas_dokumen_proyeks', function (Blueprint $table) {
            $table->id();
            $table->integer('id_proyek');
            $table->integer('id_dokumen');
            $table->string('file_dok');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berkas_dokumen_proyeks');
    }
};

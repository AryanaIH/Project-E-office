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
        Schema::create('tujuan_surat', function (Blueprint $table) {
            $table->string('id_tujuan')->primary(); // ID custom
            $table->string('nama_penerima');
            $table->string('instansi')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kontak')->nullable();
            $table->timestamps();
        });
        
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tujuan_surat');
    }
};

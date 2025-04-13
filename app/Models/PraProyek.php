<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PraProyek extends Model
{
    use HasFactory;

    protected $table = 'pra_proyeks'; // opsional jika nama tabel sesuai konvensi

    protected $fillable = [
        'nama_proyek',
        'pengusul',
        'tanggal_usulan',
        'status',
        'catatan',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PraProyek extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_proyek',
        'pengusul',
        'tanggal_usulan',
        'dokumen',
        'status_dokumen',
        'keterangan_status',
        'status',
        'catatan',
    ];

    protected $casts = [
        'dokumen' => 'array', // memastikan dokumen disimpan sebagai array
        'tanggal_usulan' => 'datetime', // pastikan tanggal disimpan dalam format datetime
    ];
}

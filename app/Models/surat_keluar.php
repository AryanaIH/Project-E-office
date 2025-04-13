<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class surat_keluar extends Model
{
    protected $fillable = [
        'nomor_surat',
        'jenis_surat',
        'tanggal_surat',
        'perihal',
        'tujuan',
        'isi',
        'status',
    ];
}

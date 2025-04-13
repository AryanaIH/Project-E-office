<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pra_proyek extends Model
{
    protected $fillable = [
        'nama_proyek',
        'pengusul',
        'tanggal_usulan',
        'status',
        'catatan',
    ];
}

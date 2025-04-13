<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class berkas_dokumen_proyek extends Model
{
    protected $fillable = [
        'id_proyek',
        'id_dokumen',
        'file_dok',
    ];
}

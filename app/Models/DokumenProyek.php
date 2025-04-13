<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenProyek extends Model
{
    protected $table = 'dokumen_proyek';
    protected $primaryKey = 'id_dokumen';
    public $incrementing = false; // Karena ID bukan auto-increment
    protected $keyType = 'string';

    protected $fillable = [
        'id_dokumen',
        'jenis_dokumen',
        'template_dokumen',
        'approval',
    ];
}

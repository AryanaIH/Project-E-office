<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna';

    protected $fillable = [
        'id_pengguna',
        'nama_pengguna',
        'jabatan',
        'hak_akses',
        'password',
    ];

    public $timestamps = false;
}


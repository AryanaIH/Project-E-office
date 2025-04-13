<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function index() {
        $data = [
            'draft_surat' => 5,
            'surat_disetujui' => 12,
            'surat_terkirim' => 20,
            'proyek_baru' => 3,
            'proyek_berjalan' => 8,
            'proyek_selesai' => 15,
        ];
        return view('dashboard', compact('data')); // Pastikan data dikirim ke view
    }
}

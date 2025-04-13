<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\surat_keluar;
use PDF;

class SuratKeluarController extends Controller
{
    // Tampilkan daftar surat keluar
    public function index(Request $request)
    {
        $suratKeluar = surat_keluar::latest()->paginate(10);
        return view('suratkeluar', compact('suratKeluar'));
    }

    // Simpan surat keluar baru
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat'    => 'required|string|max:255',
            'tanggal_surat'  => 'required|date',
            'perihal'        => 'required|string|max:255',
            'tujuan'         => 'required|string|max:255',
            'isi'            => 'required|string',
        ]);

        surat_keluar::create([
            'nomor_surat'    => $this->generateNomorSurat($request->jenis_surat),
            'jenis_surat'    => $request->jenis_surat,
            'tanggal_surat'  => $request->tanggal_surat,
            'perihal'        => $request->perihal,
            'tujuan'         => $request->tujuan,
            'isi'            => $request->isi,
            'status'         => 'Terkirim',
        ]);

        return redirect()->back()->with('success', 'Surat berhasil disimpan.');
    }

    // Menampilkan detail surat keluar
    public function show($id)
    {
        $surat = surat_keluar::findOrFail($id);
        return view('surat-keluar.show', compact('surat'));
    }

    // Form edit surat keluar
    public function edit($id)
    {
        $surat = surat_keluar::findOrFail($id);
        return view('surat-keluar.edit', compact('surat'));
    }

    // Simpan perubahan surat keluar
    public function update(Request $request, $id)
    {
        $surat = surat_keluar::findOrFail($id);

        $request->validate([
            'jenis_surat'    => 'required|string|max:255',
            'tanggal_surat'  => 'required|date',
            'perihal'        => 'required|string|max:255',
            'tujuan'         => 'required|string|max:255',
            'isi'            => 'required|string',
        ]);

        $surat->update([
            'jenis_surat'    => $request->jenis_surat,
            'tanggal_surat'  => $request->tanggal_surat,
            'perihal'        => $request->perihal,
            'tujuan'         => $request->tujuan,
            'isi'            => $request->isi,
        ]);

        return redirect()->route('surat-keluar.index')->with('success', 'Surat berhasil diperbarui.');
    }

    // Unduh surat keluar dalam format PDF
    public function download($id)
    {
        $surat = surat_keluar::findOrFail($id);
        $pdf = PDF::loadView('suratKeluarPDF', compact('surat'));
        return $pdf->download('Surat_' . $surat->nomor_surat . '.pdf');
    }

    // Generate nomor surat otomatis
    private function generateNomorSurat($jenis)
    {
        $latest = surat_keluar::count() + 1;
        $bulan = date('m');
        $tahun = date('Y');
        $kode = strtoupper(substr($jenis, 0, 3));
        return sprintf("%03d/%s/%s/%s", $latest, $kode, $bulan, $tahun);
    }
}

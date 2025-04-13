<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PraProyek;

class PraProyekController extends Controller
{
    // Tampilkan daftar pra-proyek
    public function index(Request $request)
    {
        $praProyeks = PraProyek::latest()->paginate(10);
        return view('pra-proyek', compact('praProyeks'));
    }

    // Simpan pra-proyek baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_proyek'     => 'required|string|max:255',
            'pengusul'        => 'required|string|max:255',
            'tanggal_usulan'  => 'required|date',
            'status'          => 'required|string',
            'catatan'         => 'nullable|string',
        ]);

        PraProyek::create([
            'kode_proyek'     => $this->generateKodeProyek($request->nama_proyek),
            'nama_proyek'     => $request->nama_proyek,
            'pengusul'        => $request->pengusul,
            'tanggal_usulan'  => $request->tanggal_usulan,
            'status'          => $request->status,
            'catatan'         => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Pra-proyek berhasil disimpan.');
    }

    // Lihat detail satu data pra-proyek
    public function show($id)
    {
        $praProyek = PraProyek::findOrFail($id);
        return view('pra-proyek-show', compact('praProyek'));
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $praProyek = PraProyek::findOrFail($id);
        return view('pra-proyek-edit', compact('praProyek'));
    }

    // Simpan hasil edit
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_proyek'     => 'required|string|max:255',
            'pengusul'        => 'required|string|max:255',
            'tanggal_usulan'  => 'required|date',
            'status'          => 'required|string',
            'catatan'         => 'nullable|string',
        ]);

        $praProyek = PraProyek::findOrFail($id);
        $praProyek->update([
            'nama_proyek'     => $request->nama_proyek,
            'pengusul'        => $request->pengusul,
            'tanggal_usulan'  => $request->tanggal_usulan,
            'status'          => $request->status,
            'catatan'         => $request->catatan,
        ]);

        return redirect()->route('pra-proyek.index')->with('success', 'Pra-proyek berhasil diperbarui.');
    }

    // Hapus pra-proyek
    public function destroy($id)
    {
        $praProyek = PraProyek::findOrFail($id);
        $praProyek->delete();

        return redirect()->back()->with('success', 'Pra-proyek berhasil dihapus.');
    }

    // Generate kode proyek otomatis
    private function generateKodeProyek($namaProyek)
    {
        $latest = PraProyek::count() + 1;
        $kode   = strtoupper(substr($namaProyek, 0, 3));
        $tahun  = date('Y');

        return sprintf("PRJ-%03d/%s/%s", $latest, $kode, $tahun);
    }
}

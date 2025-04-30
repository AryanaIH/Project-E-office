<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PraProyek;
use Carbon\Carbon;

class PraProyekController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data pra-proyek dengan paginasi
        $praProyeks = PraProyek::latest()->paginate(10);

        // Pastikan tanggal_usulan tidak null
        foreach ($praProyeks as $item) {
            if ($item->tanggal_usulan) {
                $item->tanggal_usulan = Carbon::parse($item->tanggal_usulan);
            } else {
                $item->tanggal_usulan = null;
            }
        }

        return view('pra-proyek', compact('praProyeks'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_proyek'        => 'required|string|max:255',
            'pengusul'           => 'required|string|max:255',
            'tanggal'            => 'required|date',
            'dokumen'            => 'nullable|array',
            'dokumen.*'          => 'in:Laporan,Surat,Undangan',  // Validasi dokumen yang dipilih
            'status_dokumen'     => 'required|in:ada,belum',
            'keterangan_status'  => 'required|in:lengkap,belum',
        ]);

        // Menyimpan data pra-proyek
        PraProyek::create([
            'kode_proyek'        => $this->generateKodeProyek($request->nama_proyek),
            'nama_proyek'        => $request->nama_proyek,
            'pengusul'           => $request->pengusul,
            'tanggal_usulan'     => $request->tanggal,
            'dokumen'            => $request->dokumen ?? [],
            'status_dokumen'     => $request->status_dokumen,
            'keterangan_status'  => $request->keterangan_status,
            'status'             => 'Menunggu Review',
            'catatan'            => null,
        ]);

        return redirect()->back()->with('success', 'Pra-proyek berhasil disimpan.');
    }

    public function show($id)
    {
        $praProyek = PraProyek::findOrFail($id);

        // Pastikan tanggal_usulan tidak null
        if ($praProyek->tanggal_usulan) {
            $praProyek->tanggal_usulan = Carbon::parse($praProyek->tanggal_usulan);
        } else {
            $praProyek->tanggal_usulan = null;
        }

        return view('pra-proyek-show', compact('praProyek'));
    }

    public function edit($id)
    {
        $praProyek = PraProyek::findOrFail($id);

        // Pastikan tanggal_usulan tidak null
        if ($praProyek->tanggal_usulan) {
            $praProyek->tanggal_usulan = Carbon::parse($praProyek->tanggal_usulan);
        } else {
            $praProyek->tanggal_usulan = null;
        }

        return view('pra-proyek-edit', compact('praProyek'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_proyek'        => 'required|string|max:255',
            'pengusul'           => 'required|string|max:255',
            'tanggal'            => 'required|date',
            'dokumen'            => 'nullable|array',
            'dokumen.*'          => 'in:Laporan,Surat,Undangan',  // Validasi dokumen yang dipilih
            'status_dokumen'     => 'required|in:ada,belum',
            'keterangan_status'  => 'required|in:lengkap,belum',
            'status'             => 'required|in:Menunggu Review,Disetujui,Ditolak',
            'catatan'            => 'nullable|string',
        ]);

        $praProyek = PraProyek::findOrFail($id);

        // Update data pra-proyek
        $praProyek->update([
            'nama_proyek'        => $request->nama_proyek,
            'pengusul'           => $request->pengusul,
            'tanggal_usulan'     => $request->tanggal,
            'dokumen'            => $request->dokumen ?? [],
            'status_dokumen'     => $request->status_dokumen,
            'keterangan_status'  => $request->keterangan_status,
            'status'             => $request->status,
            'catatan'            => $request->catatan,
        ]);

        return redirect()->route('pra-proyek.index')->with('success', 'Pra-proyek berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $praProyek = PraProyek::findOrFail($id);
        $praProyek->delete();

        return redirect()->back()->with('success', 'Pra-proyek berhasil dihapus.');
    }

    private function generateKodeProyek($namaProyek)
    {
        // Generate kode proyek berdasarkan jumlah proyek yang ada
        $latest = PraProyek::count() + 1;
        $kode   = strtoupper(substr($namaProyek, 0, 3));
        $tahun  = date('Y');

        return sprintf("PRJ-%03d/%s/%s", $latest, $kode, $tahun);
    }
}

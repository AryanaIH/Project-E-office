<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenProyek;
use Illuminate\Support\Facades\Storage;

class DokumenProyekController extends Controller
{
    public function index()
    {
        $data = DokumenProyek::all();
        return view('dokumen-proyek', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_dokumen' => 'required|unique:dokumen_proyek,id_dokumen', // sudah disesuaikan
            'jenis_dokumen' => 'required',
            'approval' => 'nullable|string',
            'template_dokumen' => 'nullable|file|max:2048',
        ]);

        $path = $request->file('template_dokumen')?->store('dokumen_templates');

        DokumenProyek::create([
            'id_dokumen' => $request->id_dokumen,
            'jenis_dokumen' => $request->jenis_dokumen,
            'approval' => $request->approval,
            'template_dokumen' => $path,
        ]);

        return redirect()->route('dokumen-proyek.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $dokumen = DokumenProyek::findOrFail($id);
        $data = DokumenProyek::all();
        return view('dokumen-proyek', compact('dokumen', 'data'));
    }

    public function update(Request $request, $id)
    {
        $dokumen = DokumenProyek::findOrFail($id);

        $request->validate([
            'jenis_dokumen' => 'required',
            'approval' => 'nullable|string',
            'template_dokumen' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('template_dokumen')) {
            if ($dokumen->template_dokumen) {
                Storage::delete($dokumen->template_dokumen);
            }
            $dokumen->template_dokumen = $request->file('template_dokumen')->store('dokumen_templates');
        }

        $dokumen->jenis_dokumen = $request->jenis_dokumen;
        $dokumen->approval = $request->approval;
        $dokumen->save();

        return redirect()->route('dokumen-proyek.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dokumen = DokumenProyek::findOrFail($id);
        if ($dokumen->template_dokumen) {
            Storage::delete($dokumen->template_dokumen);
        }
        $dokumen->delete();

        return redirect()->route('dokumen-proyek.index')->with('success', 'Data berhasil dihapus.');
    }
}

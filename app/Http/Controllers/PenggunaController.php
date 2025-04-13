<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index(Request $request)
{
    $pengguna = Pengguna::all();
    $editData = null;

    if ($request->has('edit')) {
        $editData = Pengguna::find($request->edit);
    }

    return view('pengguna', compact('pengguna', 'editData'));
}

    public function store(Request $request)
    {
        $request->validate([
            'id_pengguna' => 'required|unique:pengguna,id_pengguna',
            'nama_pengguna' => 'required',
            'jabatan' => 'required',
            'hak_akses' => 'required',
            'password' => 'required',
        ]);

        Pengguna::create([
            'id_pengguna' => $request->id_pengguna,
            'nama_pengguna' => $request->nama_pengguna,
            'jabatan' => $request->jabatan,
            'hak_akses' => $request->hak_akses,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Data berhasil disimpan!');
    }

    public function destroy($id)
    {
        $pengguna = Pengguna::findOrFail($id);
        $pengguna->delete();

        return back()->with('success', 'Data berhasil dihapus!');
    }

    public function update(Request $request, $id)
    {
        $pengguna = Pengguna::findOrFail($id);

        $pengguna->update([
            'nama_pengguna' => $request->nama_pengguna,
            'jabatan' => $request->jabatan,
            'hak_akses' => $request->hak_akses,
            'password' => $request->password ? Hash::make($request->password) : $pengguna->password,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Data berhasil diperbarui!');
    }
}

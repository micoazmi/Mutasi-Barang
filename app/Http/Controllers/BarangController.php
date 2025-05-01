<?php
namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index() {
        return Barang::all();
    }

    public function store(Request $request) {
        $request->validate([
            'nama_barang' => 'required', 'kode' => 'required|unique:barangs',
            'kategori' => 'required', 'lokasi' => 'required'
        ]);
        return Barang::create($request->all());
    }

    public function show($id) {
        return Barang::findOrFail($id);
    }

    public function update(Request $request, $id) {
        $barang = Barang::findOrFail($id);
        $barang->update($request->all());
        return $barang;
    }

    public function destroy($id) {
        return Barang::destroy($id);
    }

    public function historyMutasiBarang($id)
    {
        $barang = Barang::with('mutasis')->findOrFail($id);

        return response()->json([
            'barang' => $barang,
            'mutasi_history' => $barang->mutasis
        ]);
    }
}

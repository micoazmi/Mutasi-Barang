<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Mutasi;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function index() {
        return Mutasi::with('user', 'barang')->get();
    }

    public function store(Request $request) {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_mutasi' => 'required',
            'jumlah' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'barang_id' => 'required|exists:barangs,id',
        ]);

        return Mutasi::create($request->all());
    }

    public function show($id) {
        return Mutasi::with('user', 'barang')->findOrFail($id);
    }

    public function update(Request $request, $id) {
        $mutasi = Mutasi::findOrFail($id);
        $mutasi->update($request->all());
        return $mutasi;
    }

    public function destroy($id) {
        return Mutasi::destroy($id);
    }


    public function historyMutasiByUserId($id)
    {
    $user = User::findOrFail($id); 

    $mutasiHistory = $user->mutasis()->with('barang')->get();

    return response()->json([
        'user' => $user,
        'mutasi_history' => $mutasiHistory
    ]);
    }

}

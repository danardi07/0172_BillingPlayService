<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Perangkat;
use Illuminate\Http\Request;

class PerangkatController extends Controller
{
    public function index(Request $request)
        {
            $user = $request->user();

            if ($user->role === 'admin') {

                $data = Perangkat::where('cabang_id', $user->cabang_id)->get();
            } elseif ($user->role === 'superadmin') {

                $data = Perangkat::all();
            } else {

                return response()->json(['message' => 'Unauthorized'], 403);
            }

            return response()->json($data);
        }


    public function store(Request $request) {
        $request->validate([
            'nama' => 'required',
            'cabang_id' => 'required|exists:cabangs,id',
        ]);

        $perangkat = Perangkat::create($request->all());
        return response()->json($perangkat, 201);
    }

    public function destroy($id) {
        $perangkat = Perangkat::findOrFail($id);
        $perangkat->delete();
        return response()->json(null, 204);
    }

    public function getByCabang($cabangId)
    {
        $perangkat = Perangkat::where('cabang_id', $cabangId)->get();

        return response()->json([
            'message' => 'Data perangkat berdasarkan cabang berhasil diambil',
            'data' => $perangkat
        ]);
    }
}

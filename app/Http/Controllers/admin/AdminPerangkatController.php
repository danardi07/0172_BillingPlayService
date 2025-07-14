<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPerangkatController extends Controller
{
    public function index() {
        $user = Auth::user();
        return Perangkat::where('cabang_id', $user->cabang_id)->get();
    }

    public function store(Request $request) {
    $user = Auth::user();

    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'tipe' => 'nullable|string|max:50',
        'harga_per_jam' => 'nullable|numeric|min:0',
    ]);

    $perangkat = Perangkat::create([
        'nama' => $validated['nama'],
        'tipe' => $validated['tipe'] ?? null,
        'harga_per_jam' => $validated['harga_per_jam'] ?? null,
        'cabang_id' => $user->cabang_id,
    ]);

    return response()->json([
        'message' => 'Perangkat berhasil ditambahkan',
        'data' => $perangkat
    ], 201);
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

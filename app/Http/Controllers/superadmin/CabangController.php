<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use App\Models\User;
use App\Models\Perangkat;
use App\Models\Billing;
use Illuminate\Http\Request;

class CabangController extends Controller
{
   public function index()
    {
        return response()->json([
            'total_cabang' => Cabang::count(),
            'total_admin' => User::where('role', 'admin')->count(),
            'total_kasir' => User::where('role', 'kasir')->count(),
            'total_perangkat' => Perangkat::count(),
            'total_transaksi' => Billing::count(),
            'total_pendapatan' => Billing::sum('total_harga'),
            'cabangs' => Cabang::all(),
        ]);
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'alamat' => 'required|string',
        'no_telp' => 'required|string',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
    ]);

     $cabang = Cabang::create([
        'name' => $validated['name'],
        'alamat' => $validated['alamat'],
        'no_telp' => $validated['no_telp'],
        'latitude' => $validated['latitude'],
        'longitude' => $validated['longitude'],
    ]);

    return response()->json([
        'message' => 'Cabang berhasil ditambahkan',
        'data' => $cabang,
    ], 201);
}


}

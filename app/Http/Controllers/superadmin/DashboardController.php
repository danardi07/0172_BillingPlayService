<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\Cabang;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perangkat;
use App\Models\Billing;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_cabang' => Cabang::count(),
            'total_admin' => User::where('role', 'admin')->count(),
            'total_kasir' => User::where('role', 'kasir')->count(),
            'total_perangkat' => Perangkat::count(),
            'total_transaksi' => Billing::count(),
            'total_pendapatan' => (int) Billing::sum('total_harga'),
            'cabangs' => Cabang::all(),
            'admins' => User::where('role', 'admin')->get(['id', 'name', 'email']),
            'kasirs' => User::where('role', 'kasir')->get(['id', 'name', 'email']),
            'perangkat' => Perangkat::select('id', 'cabang_id', 'nama', 'tipe', 'harga_per_jam')->get(),
            'transaksi' => Billing::selectRaw("jenis_ps as tipe, COALESCE(total_harga, 0) as total, created_at")->get(),

        ]);
    }



    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required|numeric',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $cabang = Cabang::create($request->all());
        return response()->json($cabang, 201);
    }

    public function show($id) {
        return Cabang::findOrFail($id);
    }
}

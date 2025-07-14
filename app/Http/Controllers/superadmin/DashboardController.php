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
            'total_pendapatan' => Billing::sum('total_harga'),
            'cabangs' => Cabang::all(),
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

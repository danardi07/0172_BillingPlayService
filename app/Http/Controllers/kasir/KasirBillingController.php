<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use App\Models\Perangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasirBillingController extends Controller
{

    public function index()
{
    $user = auth()->user();

    $billings = Billing::with([
        'user:id,name,email,cabang_id',
        'perangkat:id,nama,tipe,harga_per_jam,cabang_id'
    ])
    ->where('user_id', $user->id)
    ->select('id', 'user_id', 'perangkat_id', 'durasi', 'start_time', 'end_time', 'status', 'photo_url', 'total_harga', 'nama_pelanggan', 'jenis_pembayaran', 'created_at')
    ->get();

    return response()->json($billings);
}

public function store(Request $request)
{
    $request->validate([
        'perangkat_id' => 'required|exists:perangkats,id',
        'durasi' => 'required|integer|min:1',
        'nama_pelanggan' => 'required|string|max:255',
        'jenis_pembayaran' => 'required|string|max:255',
        'photo_url' => 'nullable|url',
    ]);

    $perangkat = Perangkat::findOrFail($request->perangkat_id);
    $totalHarga = $perangkat->harga_per_jam * $request->durasi;

    $billing = Billing::create([
        'user_id' => auth()->id(),
        'perangkat_id' => $request->perangkat_id,
        'durasi' => $request->durasi,
        'status' => 'ongoing',
        'photo_url' => $request->photo_url,
        'total_harga' => $totalHarga,
        'nama_pelanggan' => $request->nama_pelanggan,
        'jenis_pembayaran' => $request->jenis_pembayaran,
    ]);

    return response()->json($billing, 201);
}


    public function updateStatus($id, Request $request) {
        $billing = Billing::findOrFail($id);

        $request->validate([
            'status' => 'required|in:ongoing,completed,cancelled',
        ]);

        $billing->status = $request->status;
        $billing->save();

        return response()->json($billing);
    }


}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBillingRequest;
use App\Http\Requests\UpdateBillingStatusRequest;
use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KasirController extends Controller
{
    // ✅ Melihat daftar billing milik kasir yang login
    public function index()
    {
        $billings = Billing::with('perangkat', 'cabang')
            ->where('kasir_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $billings
        ]);
    }

    // ✅ Menyimpan billing baru
    public function store(StoreBillingRequest $request)
    {
        $billing = Billing::create([
            'kasir_id'     => Auth::id(),
            'cabang_id'    => $request->cabang_id,
            'perangkat_id' => $request->perangkat_id,
            'start_time'   => $request->start_time,
            'status'       => 'aktif'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Billing berhasil dibuat',
            'data' => $billing
        ]);
    }

    // ✅ Mengubah status billing ke "selesai"
    public function updateStatus(UpdateBillingStatusRequest $request, $id)
    {
        $billing = Billing::where('id', $id)
            ->where('kasir_id', Auth::id())
            ->firstOrFail();

        if ($request->hasFile('foto_transaksi')) {
            $path = $request->file('foto_transaksi')->store('public/foto_transaksi');
            $fotoUrl = Storage::url($path);
            $billing->foto_transaksi = $fotoUrl;
        }

        $billing->update([
            'end_time'    => $request->end_time,
            'total_bayar' => $request->total_bayar,
            'status'      => 'selesai'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Billing selesai',
            'data' => $billing
        ]);
    }
}

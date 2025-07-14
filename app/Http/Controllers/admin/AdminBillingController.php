<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminBillingController extends Controller
{
    public function index() {
        $user = Auth::user();
        return Billing::whereHas('perangkat', function ($query) use ($user) {
            $query->where('cabang_id', $user->cabang_id);
        })->with(['perangkat', 'user'])->get();
    }

    public function billingByCabang($cabangId)
{
    // Validasi cabang_id terlebih dahulu
    if (!\App\Models\Cabang::where('id', $cabangId)->exists()) {
        return response()->json([
            'message' => 'Cabang tidak ditemukan',
        ], 404);
    }

    // Ambil billing berdasarkan perangkat di cabang tersebut
    $billings = Billing::whereHas('perangkat', function ($query) use ($cabangId) {
        $query->where('cabang_id', $cabangId);
    })->with([
        'user:id,name,email,role,cabang_id',
        'perangkat:id,nama,tipe,harga_per_jam,cabang_id'
    ])
    ->get();

    return response()->json([
        'message' => 'Data billing berdasarkan cabang berhasil diambil',
        'data' => $billings
    ]);


}

}

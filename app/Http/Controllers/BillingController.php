<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;

class BillingController extends Controller
{

    public function index()
    {
        $billings = Billing::with(['kasir', 'perangkat', 'cabang'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $billings
        ]);
    }


    public function byCabang(Request $request)
    {
        $cabangId = $request->user()->cabang_id;

        $billings = Billing::with(['kasir', 'perangkat'])
            ->where('cabang_id', $cabangId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $billings
        ]);
    }


    public function active(Request $request)
    {
        $billing = Billing::with('perangkat')
            ->where('kasir_id', $request->user()->id)
            ->where('status', 'Digunakan')
            ->first();

        return response()->json([
            'status' => true,
            'data' => $billing
        ]);
    }
    public function show($id)
    {
        $billing = Billing::with(['kasir', 'perangkat', 'cabang'])->findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $billing
        ]);
    }
}

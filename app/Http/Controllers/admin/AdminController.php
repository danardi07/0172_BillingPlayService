<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Lihat daftar admin per cabang (khusus SuperAdmin)
    public function index()
    {
        $admins = User::where('role', 'admin')
            ->with('cabang')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $admins
        ]);
    }

    // SuperAdmin menambahkan Admin baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|min:6',
            'no_telp'   => 'nullable|string|max:20',
            'cabang_id' => 'required|exists:cabangs,id',
        ]);

        $admin = User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'no_telp'   => $validated['no_telp'] ?? null,
            'role'      => 'admin',
            'cabang_id' => $validated['cabang_id'],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Admin berhasil dibuat',
            'data' => $admin,
        ]);
    }
}

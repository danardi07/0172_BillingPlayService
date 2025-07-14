<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterKasirController extends Controller
{
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|string|min:6',
            'no_telp'   => 'nullable|string|max:20',
            'cabang_id' => 'required|exists:cabangs,id',
        ]);

        $kasir = User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'no_telp'   => $validated['no_telp'] ?? null,
            'role'      => 'kasir',
            'cabang_id' => $validated['cabang_id'],
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Registrasi kasir berhasil',
            'data'    => $kasir,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SuperAdminController extends Controller
{

    public function profile(Request $request)
    {
        return response()->json([
            'status' => true,
            'data' => $request->user()
        ]);
    }

  
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'no_telp'  => 'nullable|string|max:20',
            'password' => 'nullable|min:6',
        ]);

        $user->name    = $validated['name'];
        $user->email   = $validated['email'];
        $user->no_telp = $validated['no_telp'] ?? null;

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'Profil berhasil diperbarui',
            'data' => $user
        ]);
    }
}

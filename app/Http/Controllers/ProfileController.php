<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    public function me(Request $request)
    {
        $user = auth()->user()->load('cabang:id,name');

        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'no_telp' => $user->no_telp,
            'cabang_id' => $user->cabang_id,
            'cabang_name' => $user->cabang->name ?? null, 
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
        ]);
    }


    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return response()->json(['message' => 'Profil berhasil diperbarui', 'user' => $user]);
    }
}

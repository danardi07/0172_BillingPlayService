<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterKasirRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|string|min:6|confirmed',
            'no_telp'    => 'nullable|string|max:20',
            'cabang_id'  => 'required|exists:cabangs,id',
        ];
    }
}

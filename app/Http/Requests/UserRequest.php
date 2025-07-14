<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . $this->user],
            'password' => ['nullable', 'string', 'min:6'],
            'no_telp' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'in:superadmin,admin,kasir'],
            'cabang_id' => ['nullable', 'exists:cabangs,id'],
        ];
    }
}

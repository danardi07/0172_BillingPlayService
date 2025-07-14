<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CabangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:100'],
            'alamat' => ['nullable', 'string'],
            'latitude' => ['nullable', 'numeric'],
            'longitude' => ['nullable', 'numeric'],
            'no_telp' => ['nullable', 'numeric'],
        ];
    }
}

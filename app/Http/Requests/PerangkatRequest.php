<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PerangkatRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => ['required', 'string', 'max:100'],
            'tipe' => ['required', 'in:ps,tv,lainnya'],
            'status' => ['required', 'in:aktif,tidak_aktif'],
            'harga_per_jam' => ['required', 'numeric', 'min:0'],
            'cabang_id' => ['required', 'exists:cabangs,id'],
        ];
    }
}

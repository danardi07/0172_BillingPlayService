<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'perangkat_id' => ['required', 'exists:perangkats,id'],
            'durasi' => ['required', 'integer', 'min:1'],
            'total_harga' => ['required', 'numeric', 'min:0'],
            'status' => ['nullable', 'in:aktif,selesai'],
        ];
    }
}

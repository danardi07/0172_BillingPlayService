<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBillingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cabang_id' => 'required|exists:cabangs,id',
            'perangkat_id' => 'required|exists:perangkats,id',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
        ];
    }
}


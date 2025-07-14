<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBillingStatusRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'end_time' => 'required|date_format:Y-m-d H:i:s|after_or_equal:start_time',
            'total_bayar' => 'required|integer',
            'foto_transaksi' => 'nullable|image|max:2048'
        ];
    }
}

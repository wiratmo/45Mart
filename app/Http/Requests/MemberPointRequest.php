<?php

namespace App\Http\Requests;


class MemberPointRequest extends MyRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
            'store_id' => 'required|integer',
            'transaction_price' => 'required',
            'date_at' => 'required|date_format:Y-m-d',
            'point' => 'required'
        ];
    }
}

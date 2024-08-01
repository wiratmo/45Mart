<?php

namespace App\Http\Requests;

class DetailUserRequest extends MyRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // first step on registration member
        return [
            'dob' => 'required|date_format:Y-m-d',
            'gender' => 'required',
            'identity_type'=> 'required',
            'identity_number'=> 'required',
            'address' => 'required',
            'phone'=> 'required',
        ];
    }
}

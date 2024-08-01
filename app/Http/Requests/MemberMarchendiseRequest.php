<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberMarchendiseRequest extends MyRequest
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
            'marchendise_id' => 'required|integer',
            'date_at' => 'required|date_format:Y-m-d',
        ];
    }
}

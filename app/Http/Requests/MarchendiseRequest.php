<?php

namespace App\Http\Requests;


class MarchendiseRequest extends MyRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:categories,name',
            'date_start' => 'required|date_format:Y-m-d|before_or_equal:date_end',
            'date_end' => 'required|date_format:Y-m-d|after_or_equal:date_start',
            'quota' => 'required|integer',
            'point' => 'required'
        ];
    }
}

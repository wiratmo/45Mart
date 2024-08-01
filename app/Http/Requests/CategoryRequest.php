<?php

namespace App\Http\Requests;

class CategoryRequest extends MyRequest
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
            'point_criteria' => 'required|numeric'
        ];
    }

}

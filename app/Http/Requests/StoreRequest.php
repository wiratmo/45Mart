<?php

namespace App\Http\Requests;


class StoreRequest extends MyRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'name' => 'required|max:255|unique:categories,name',
            'floor_position' => 'nullable|integer',
            'store_position' => 'nullable|integer',
        ];
    }
}

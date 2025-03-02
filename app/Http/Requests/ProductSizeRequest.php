<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductSizeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required','unique:product_sizes', 'max:255'],
            'multiplier' => ['required','unique:product_sizes', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'multiplier.requred' => 'Description is required!',
            'name.unique' => 'Size Exist!',
            'multiplier.unique' => 'Size Exist!',
        ];
    }
}

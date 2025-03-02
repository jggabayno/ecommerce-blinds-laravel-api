<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'user_name' => ['unique:users,id'],
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'mobile_number' => ['unique:users,mobile_number'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        ];
    }

}

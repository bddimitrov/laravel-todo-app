<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class RegisterFormRequest extends BaseFormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users',
            ],
            'password' => [
                'required',
                'confirmed',
                'min:6',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
            ],
        ];
    }
}

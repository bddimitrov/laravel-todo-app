<?php

namespace App\Http\Requests\User;

use App\Http\Requests\BaseFormRequest;

class LoginFormRequest extends BaseFormRequest
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
            ],
            'password' => ['required'],
        ];
    }
}

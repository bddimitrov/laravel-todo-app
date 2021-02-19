<?php

namespace App\Http\Requests\Todo;

use App\Http\Requests\BaseFormRequest;

/**
 * Class CreateTodoRequest
 * @package App\Http\Requests\Todo
 */
class CreateTodoRequest extends BaseFormRequest
{
    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function authorize()
    {
        return auth()->user();
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'max:255'
            ],
        ];
    }
}

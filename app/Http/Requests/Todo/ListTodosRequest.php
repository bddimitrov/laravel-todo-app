<?php

namespace App\Http\Requests\Todo;

use App\Http\Requests\BaseFormRequest;

/**
 * Class ListTodosRequest
 * @package App\Http\Requests\Todo
 */
class ListTodosRequest extends BaseFormRequest
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
        return [];
    }
}

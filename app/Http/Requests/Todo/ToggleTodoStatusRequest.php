<?php

namespace App\Http\Requests\Todo;

use App\Http\Requests\BaseFormRequest;

/**
 * Class ToggleTodoStatusRequest
 * @package App\Http\Requests\Todo
 */
class ToggleTodoStatusRequest extends BaseFormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return auth()->user() && auth()->user()->canEditTodo($this->id);
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [];
    }
}

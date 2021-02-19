<?php

namespace App\Http\Requests\Todo;

use App\Http\Requests\BaseFormRequest;

class DeleteTodoRequest extends BaseFormRequest
{
    public function authorize()
    {
        return auth()->user() && auth()->user()->canEditTodo($this->id);
    }

    public function rules()
    {
        return [];
    }
}

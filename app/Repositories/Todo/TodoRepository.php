<?php

namespace App\Repositories\Todo;

use App\Models\Todo;
use App\Models\User;

/**
 * Class TodoRepository
 * @package App\Repositories\Todo
 */
class TodoRepository {

    /**
     * @var User
     */
    private $user;

    /**
     * TodoRepository constructor.
     */
    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
     * @return mixed
     */
    public function items()
    {
        $items = Todo::where('user_id', $this->user->id)->get();
        return $items;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        $data['user_id'] = $this->user->id;

        $todo = Todo::create($data);
        return $todo;
    }

    /**
     * @param $id
     * @return bool
     */
    public function toggleStatus($id)
    {
        $todo = Todo::find($id);
        $todo->completed = !$todo->completed;
        $todo->save();

        return true;
    }

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id)
    {
        Todo::find($id)->delete();
        return true;
    }
}

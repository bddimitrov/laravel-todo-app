<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Http\Requests\Todo\CreateTodoRequest;
use App\Http\Requests\Todo\DeleteTodoRequest;
use App\Http\Requests\Todo\ListTodosRequest;
use App\Http\Requests\Todo\ToggleTodoStatusRequest;
use App\Http\Resources\TodoResource;
use App\Repositories\Todo\TodoRepository;

/**
 * Class TodoController
 * @package App\Http\Controllers\Todo
 */
class TodoController extends Controller
{
    /**
     * @param ListTodosRequest $request
     * @param TodoRepository $repo
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function items(ListTodosRequest $request, TodoRepository $repo)
    {
        $items = $repo->items();
        return TodoResource::collection($items);
    }

    /**
     * @param CreateTodoRequest $request
     * @param TodoRepository $repo
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(CreateTodoRequest $request, TodoRepository $repo)
    {
        $data = $request->validated();
        $repo->store($data);

        return response([],200);
    }

    /**
     * @param ToggleTodoStatusRequest $request
     * @param $id
     * @param TodoRepository $repo
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function toggleStatus(ToggleTodoStatusRequest $request, $id, TodoRepository $repo)
    {
        $repo->toggleStatus($id);
        return response([],200);
    }

    /**
     * @param DeleteTodoRequest $request
     * @param $id
     * @param TodoRepository $repo
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function destroy(DeleteTodoRequest $request, $id, TodoRepository $repo)
    {
        $repo->destroy($id);
        return response([],200);
    }
}

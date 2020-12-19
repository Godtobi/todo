<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTodoRequest;
use App\Models\TodoList;
use App\Repositories\TodoRepository;
use App\Repositories\UserRepository;
use App\Traits\Errors;
use Illuminate\Http\Request;

class TodoApiController extends Controller
{
    use Errors;

    private $todoRepository;

    public function __construct(TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = $this->todoRepository->getAllTodo();
        return $this->sendSuccessResponseWithData($todos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTodoRequest $request)
    {
        $todo = $this->todoRepository->createTodo($request->validated());
        return $this->sendSuccessResponseWithDataAndCode($todo,201,"Todo Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TodoList $todo)
    {
        return $this->sendSuccessResponseWithData($todo->load("user"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateTodoRequest $request, $id)
    {
        $todo = $this->todoRepository->updateTOdo($request->validated(),$id);
        return $this->sendSuccessResponseWithData($todo,"Todo updated  successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->todoRepository->deleteTodo($id);
        return $this->sendSuccessResponseWithoutData("Todo deleted");
    }
}

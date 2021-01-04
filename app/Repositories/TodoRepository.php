<?php

namespace App\Repositories;

use App\Models\TodoList;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class TodoRepository.
 */
class TodoRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return TodoList::class;
    }

    protected $fieldSearchable = [
        'name',
        'email',
    ];

    public function getAllTodo(){

        try {
            return $this->all()->load("user");
        }
        catch (\Exception $e) {
            throw $e;
        }

    }


    public function createTodo($data){
        try {
           return $this->create($data);
        }
        catch (\Exception $exception){
            throw $exception;
        }
    }

    public function updateTOdo($data, $id){

        try {
            return $this->updateById($id,$data);
        }
        catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("Todo not found");
        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    public function deleteTodo($id){
        try {
            return $this->deleteById($id);
        }
        catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("Todo not found");
        }
        catch (\Exception $exception){
            throw $exception;
        }

    }
}

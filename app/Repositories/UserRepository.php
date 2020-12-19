<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;


//use Your Model

/**
 * Class UserRepository.
 */
class UserRepository extends AppBaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
    ];

    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }

    public function getAllUsers($orderBy = "email"){

        try {
            return User::orderBy($orderBy)->get();
        }
        catch (\Exception $e) {
            throw $e;
        }

    }

    public function show($id)
    {

        try {
            return User::findorfail($id);
        }
        catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("User not found");
        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    public function updateUser($data, $id){

        try {
            return $this->updateById($id,$data);
        }
        catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("User not found");
        }
        catch (\Exception $e) {
            throw $e;
        }
    }

    public function deleteUser($id){
        try {
            return $this->deleteById($id);
        }
        catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException("User not found");
        }
        catch (\Exception $exception){
            throw $exception;
        }

    }

}

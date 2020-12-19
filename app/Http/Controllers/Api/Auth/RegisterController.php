<?php

namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\Errors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use Errors;

    public function register(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:users',
            'password'=>'required',
            'name'=>'required'
        ]);
        if($validator->fails()){
            $errorMessage = $validator->errors()->first();
            return $this->sendError($errorMessage,400);
        }
        $data = $validator->validated();
        $data['password'] = Hash::make($request->get('password'));
        $user = User::create($data);
        $response['token'] = $user->createToken(config('app.name'))->accessToken;
        $response['user'] = $user;
        $message = "user created";
        return $this->sendSuccessResponseWithDataAndCode($response,201, $message);
    }
}

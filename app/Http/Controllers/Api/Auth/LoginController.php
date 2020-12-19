<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Traits\Errors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use Errors;

    public function login(Request $request){
        $auth = $request->validate([
           'email'=>'required',
           'password'=>'required'
        ]);
        if(!Auth::attempt($auth)){
            return $this->sendError('Invalid email or password',401);
        }
        $user = Auth::user();
        $data['user'] = $user;
        $data['token'] = $user->createToken(config('app.name'))->accessToken;
        $message = "login successful";
        return $this->sendSuccessResponseWithData($data, $message);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegestrationRequest;
use App\libs\Response\GlobalApiResponse;
use App\libs\Response\GlobalApiResponseCodeBook;
use App\User;

class AuthController extends Controller
{
     public function register(RegestrationRequest $request)
     {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        return (new GlobalApiResponse())->success('User registered successfully', 1,1);
    }

    public function login(LoginRequest $request)
    {
    	$data = array();
        $credentials = $request->only('email', 'password');
        if ($token = Auth()->guard()->attempt($credentials)) {
        	$data['status']=true;
        	$data['_token']=\Hash::make(rand(2423,124));
            return (new GlobalApiResponse())->success('Successfully logged in', 1, $data);
        }
        $data['status']=false;
        $data['_token']=null;
        return (new GlobalApiResponse())->error(GlobalApiResponseCodeBook::INVALID_FORM_INPUTS, 'Invalid Credentials', $data);
    }

}

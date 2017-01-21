<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'mobile' => 'required|digits:10|unique:users',
            'country_code' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages()->all(), 422);
        }

        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $country_code = $request->input('country_code');
        $mobile = $request->input('mobile');

        $user = new User([
            'name' => $name,
            'email' => $email,
            'code' => $country_code,
            'mobile' => $mobile,
            'password' => bcrypt($password)
        ]);

        if ($user->save()) {
            return response()->json($user);
        }

        $response = [
            'msg' => 'An error occurred'
        ];

        return response()->json($response, 404);
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }
}

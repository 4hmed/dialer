<?php

namespace App\Http\Controllers\Api\v1;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function user()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user not found'], 404);
            }

        } catch (JWTException $e) {

            return response()->json([$e->getMessage()], $e->getStatusCode());

        }

        $user = User::with('contacts')->with('contacts.phones')->with('contacts.groups')->where('id', $user->id)->get();
        // the token is valid and we have found the user via the sub claim
        return response()->json($user);
    }

    public function updateDetails(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user not found'], 404);
            }
        } catch (JWTException $e) {
            return response()->json([$e->getMessage()], $e->getStatusCode());
        }

        $validation = Validator::make($request->all(), [
            "name" => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'required|digits:10|unique:users,mobile,' . $user->id,
            'country_code' => 'required',
            'birth_date' => 'required|date|date_format:Y-m-d',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages()->all(), 422);
        }

        $user = User::findOrFail($user->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->code = $request->country_code;
        $user->dob = $request->birth_date;
        $user->update();

        return response()->json($user);

    }

    public function updateImage(Request $request)
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user not found'], 404);
            }
        } catch (JWTException $e) {
            return response()->json([$e->getMessage()], $e->getStatusCode());
        }

        $validation = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->messages()->all(), 422);
        }
        $image = $request->file('image');

        $imageName = rand() . '_' . round(microtime(true) * 1000) . '.' . $image->getClientOriginalExtension();
        $location = public_path('uploads/imgs/');
        $image->move($location, $imageName);
        $user->image = $imageName;
        $user->update();
        return response()->json($user);

    }

    public function updatePassword(Request $request)
    {

        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user not found'], 404);
            }
        } catch (JWTException $e) {
            return response()->json([$e->getMessage()], $e->getStatusCode());
        }
        $validation = Validator::make($request->all(), [
            'current_password' => 'required|old_password:' . $user->password,
            'password' => 'required|min:6|confirmed',
        ]);
        if ($validation->fails()) {
            return response()->json($validation->messages()->all(), 422);
        }
        $user->password = bcrypt($request->password);
        $user->update();
        return response()->json($user);

    }


    public function userContacts()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user not found'], 404);
            }

        } catch (JWTException $e) {

            return response()->json([$e->getMessage()], $e->getStatusCode());

        }
        $user = User::with('groups', 'contacts', 'contacts.phones', 'contacts.groups')->where('id', $user->id)->get();
        return response()->json($user);
    }

    public function userGroups()
    {
        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user not found'], 404);
            }

        } catch (JWTException $e) {

            return response()->json([$e->getMessage()], $e->getStatusCode());

        }

        // the token is valid and we have found the user via the sub claim
        return response()->json($user->groups);
    }


}

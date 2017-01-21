<?php

namespace App\Http\Controllers\Api\v1;

use App\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;

class GroupController extends Controller
{
    public $user;

    function __construct(JWTAuth $user)
    {
        $this->user = $user;
        try {
            if (!$this->user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['msg' => 'User not found'], 404);
            }
        } catch (JWTException  $e) {
            return response()->json(['msg' => $e->getMessage()], $e->getStatusCode());
        }
        return $this->user;
    }

    public function store(Request $request, $id)
    {
        $validation = Validator::make($request->all(), array(
            'name' => 'required'
        ));
        if ($validation->fails()) {
            return response()->json($validation->messages()->all(), 422);

        }

        $group = new Group();

        $group->name = $request->name;
        $group->user_id = $this->user->id;
        if ($group->save()) {
            $groups = Group::where('user_id', $this->user->id)->get();
            return response()->json($groups);
        }
        $response = [
            'msg' => 'An error occurred'
        ];

        return response()->json($response, 404);
    }


    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), array(
            'name' => 'required'
        ));
        if ($validation->fails()) {
            return response()->json($validation->messages()->all(), 422);

        }

        $group = Group::findOrFail($id);
        if ($group->user_id != $this->user->id) {
            return response()->json(['msg' => 'You are not authorized'], 404);
        }

        $group->name = $request->name;
        if ($group->save()) {
            $groups = Group::where('user_id', $this->user->id)->get();
            return response()->json($groups);
        }
        $response = [
            'msg' => 'An error occurred'
        ];

        return response()->json($response, 404);
    }

    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        if ($group->user_id != $this->user->id) {
            return response()->json(['msg' => 'You are not authorized'], 404);
        }

        if ($group->delete()) {
            $groups = Group::where('user_id', $this->user->id)->get();
            return response()->json($groups);
        }
        $response = [
            'msg' => 'An error occurred'
        ];

        return response()->json($response, 404);
    }

}

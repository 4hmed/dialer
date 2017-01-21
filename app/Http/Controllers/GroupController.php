<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use Auth;
use Illuminate\Http\Request;

class GroupController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return Group|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required'
        ));
        $user = Auth::user();

        $group = new Group();

        $group->name = $request->name;
        $group->user_id = $user->id;
        $group->save();
        return redirect()->back()->with('user', $user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, array(
            'name' => 'required'
        ));

        $group = Group::findOrFail($id);
        $user = Auth::user();
        if ($group->user_id != $user->id || $user->cant(['update-user-group'])) {
            $user = User::findOrFail($group->user_id);
            return redirect()->back()->with('user', $user);
        }
        $group->name = $request->name;
        $group->update();
        $user = User::findOrFail($group->user_id);
        return redirect()->back()->with('user', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $group = Group::findOrFail($id);
        $user = Auth::user();
        if ($group->user_id != $user->id || $user->cant(['delete-user-group'])) {
            $user = User::findOrFail($group->user_id);
            return redirect()->back()->with('user', $user);
        }
        $group->delete();
        $user = User::findOrFail($group->user_id);
        return redirect()->back()->with('user', $user);
    }
}

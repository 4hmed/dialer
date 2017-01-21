<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        $perms = Permission::all();
        return view('roles')->with('roles', $roles)->with('perms', $perms);

    }

    public function store(Request $request)
    {
        $role = new Role;
        $this->validate($request, array(
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'description' => 'required',
        ));
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();
        $roles = Role::all();
        $perms = Permission::all();
        return redirect()->back()->with('roles', $roles)->with('perms', $perms);

    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $this->validate($request, array(
            'name' => 'required|unique:roles,name,' . $role->id,
            'display_name' => 'required',
            'description' => 'required',
        ));
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->update();
        $roles = Role::all();
        $perms = Permission::all();
        return redirect()->back()->with('roles', $roles)->with('perms', $perms);
    }

    public function updatePerms(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $permsid = [];
        if ($request->perms) {
            foreach ($request->perms as $id) {
                if (Permission::where('id', $id)->count()) {
                    $permsid[] = $id;
                }
            }
        }
        $role->perms()->sync($permsid);
        $roles = Role::all();
        $perms = Permission::all();
        return redirect()->back()->with('roles', $roles)->with('perms', $perms);    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->users()->sync([]);
        $role->perms()->sync([]);
        $role->delete();
        $roles = Role::all();
        $perms = Permission::all();
        return redirect()->back()->with('roles', $roles)->with('perms', $perms);    }

}

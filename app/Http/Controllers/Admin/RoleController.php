<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //Show index view
    public function index()
    {
        // $roles = Role::all(); //Get all roles from database
        //get roles except super_admin & admin
        $roles = Role::whereNotIn('name', ['super_admin', 'admin'])->get();
        return view('admin.roles.index', compact('roles'));
    }

    //Show create view
    public function create()
    {
        return view('admin.roles.create');
    }

    //Add role to a db
    public function store(Request $request)
    {
        //Laravel validation //name=> same as a database && text input id
        $validated = $request->validate(['name' => ['required', 'min:3']]);

        Role::create($validated); //Store validate data in datanbase

        return to_route('admin.roles.index')->with('message', 'Role Added Sucessfully!'); //Automatically return to role.index
    }

    //Show edit view
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    //Update role in db
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate(['name' => ['required', 'min:3']]);
        $role->update($validated);
        return to_route('admin.roles.index')->with('message', 'Role Updated Sucessfully!'); //pass message to admin.blade.php
    }

    //delete role
    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with('message', 'Role Deleted!');
    }

    public function givePermission(Request $request, Role $role)
    {
        if ($role->hasPermissionTo($request->permission)) {
            return back()->with('message', 'Permission alrady granted!');
        } else {
            $role->givePermissionTo($request->permission);
            return back()->with('message', 'Permission granted!');
        }
    }

    public function revokePermission(Role $role, Permission $permission)
    {
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission Removed!');
        }
    }
}
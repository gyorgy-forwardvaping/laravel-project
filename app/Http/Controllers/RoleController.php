<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RoleController extends Controller {
    public function index() {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required']
        ]);

        Role::create([
            'name' => Str::ucfirst($request['name']),
            'slug' => Str::of(Str::lower($request['name']))->slug('-')
        ]);

        session()->flash('role-created', 'Role created!');

        return back();
    }

    public function show(Role $role) {
        $permissions = Permission::all();
        return view('admin.roles.show', compact('role', 'permissions'));
    }

    public function update(Role $role, Request $request) {
        $role->name = Str::ucfirst($request['name']);
        $role->slug = Str::of(Str::ucfirst($request['name']))->slug('-');

        if ($role->isDirty('name')) {
            session()->flash('role-updated', 'Role updated!');
            $role->save();
        } else {
            session()->flash('role-not-changed', 'No change detected!');
        }

        return back();
    }

    public function attach(Role $role, Request $request) {
        $role->permissions()->attach($request['permission']);
        session()->flash('permission-add', 'Permission added to role!');
        return back();
    }


    public function detach(Role $role, Request $request) {
        $role->permissions()->detach($request['permission']);
        session()->flash('permission-remove', 'Permission removed to role!');
        return back();
    }

    public function destroy(Role $role) {
        $role->delete();

        session()->flash('role-deleted', 'Role deleted!');

        return back();
    }
}

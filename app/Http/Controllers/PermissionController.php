<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PermissionController extends Controller {
    public function index() {
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function show(Permission $permission) {
        return view('admin.permissions.show', compact('permission'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required']
        ]);

        Permission::create([
            'name' => Str::ucfirst($request['name']),
            'slug' => Str::of(Str::lower($request['name']))->slug('-')
        ]);

        session()->flash('permission-created', 'Permission created!');

        return back();
    }

    public function update(Permission $permission, Request $request) {
        $permission->name = Str::ucfirst($request['name']);
        $permission->slug = Str::of(Str::ucfirst($request['name']))->slug('-');

        if ($permission->isDirty('name')) {
            session()->flash('permission-updated', 'Permission updated!');
            $permission->save();
        } else {
            session()->flash('permission-not-changed', 'No change detected!');
        }

        return back();
    }

    public function destroy(Permission $permission) {
        $permission->delete();

        session()->flash('permission-deleted', 'Permission deleted!');

        return back();
    }
}

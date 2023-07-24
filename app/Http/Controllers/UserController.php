<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {

    public function index() {
        $users = User::paginate(5);
        return view('admin.users.index', compact('users'));
    }
    public function show(User $user) {
        $roles = Role::all();
        return view('admin.users.profile', compact('user', 'roles'));
    }

    public function update(User $user, Request $request) {
        $inputs = $request->validate([
            'username' => ['required', 'string', 'max:255', 'alpha_dash'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'avatar' => ['file']
        ]);

        if ($request['avatar']) {
            if (strpos($user->getRawOriginal('avatar'), 'https://') === FALSE && strpos($user->getRawOriginal('avatar'), 'http://') === FALSE) {
                Storage::delete(public_path('storage/' . $user->getRawOriginal('avatar')));
            }

            $inputs['avatar'] = $request['avatar']->store('images');
        }

        $user->update($inputs);

        return back();
    }

    public function destroy(User $user) {
        $user->delete();
        session()->flash('user-delete', 'User Deleted');
        return back();
    }

    public function attachRole(User $user, Request $request) {
        $user->roles()->attach($request['role']);

        return back();
    }

    public function detachRole(User $user, Request $request) {
        $user->roles()->detach($request['role']);

        return back();
    }
}

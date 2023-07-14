<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function index() {
        $users = User::paginate(5);

        return view('admin.users.index', compact('users'));
    }
    public function show(User $user) {
        return view('admin.users.profile', compact('user'));
    }

    public function update(User $user, Request $request) {
        $inputs = $request->validate([
            'username' => ['required', 'string', 'max:255', 'alpha_dash'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'avatar' => ['file']
        ]);

        if ($request['avatar']) {
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
}

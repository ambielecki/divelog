<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller {
    public function getSettings() {
        $user = Auth::user();

        return view('auth.settings', ['user' => $user]);
    }

    public function postSettings(Request $request) {
        $this->validate($request, [
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);
        $user = Auth::user();
        if (!Hash::check($request->input('current_password'), $user->password)) {
            Session::flash('password_error', 'Password does not match our records.');

            return redirect()->route('user_settings');
        }
        $user->password = Hash::make($request->input('password'));
        $user->save();
        Session::flash('flash_success', 'Password updated successfully');

        return redirect()->route('home');
    }

    public function getList() {
        $users = User::get();
        $count = User::count();

        return view('admin.users.user_list', [
            'users'        => $users,
            'count'        => $count,
            'current_page' => 1,
            'pages'        => 1,
        ]);
    }

    public function getEdit($id = null) {
    }
}

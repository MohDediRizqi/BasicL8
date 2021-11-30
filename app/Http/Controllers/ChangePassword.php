<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Controller
{
    public function ChangePass()
    {
        return view('admin.body.change_password');
    }

    public function UpdatePassword(Request  $request)
    {
        $validateData = $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login')->with('success', 'Password Is Change Successfully');
        } else {
            return redirect()->back()->with('error', 'Current Password Is invalid');
        }
    }

    public function PUpdate()
    {
        if (Auth::user()) {
            $user = User::find(Auth::user()->id);
            if ($user) {
                return view('admin.body.update_profile', compact('user'));
            }
        }
    }

    public function UpdateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($user) {
            $user->name = $request['name'];
            $user->email = $request['email'];

            $user->save();
            return redirect()->back()->with('success', 'User Profile is Updated');
        } else {
            return redirect()->back();
        }
    }
}

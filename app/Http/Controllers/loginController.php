<?php

namespace App\Http\Controllers;

use App\Http\Requests\createAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;

class loginController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function signUpPage()
    {
        return view('signup');
    }

    public function createAccount(createAccount $request)
    {
        if ($request->password == $request->reenterPassword) {
            $user = new Users;
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('success', 'Account created successfully');
        }
        return redirect()->back()->with('failure', 'Password mismatching');
    }

    public function login(Request $request)
    {

        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ])) {
            return redirect()-> intended('/');
        }

        return redirect()->back()-> with('failure', 'Username or password didn\'t match');
    }

    public function logout(){
        Auth::logout();
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate(['email'=>'required', 'password'=>'required']);
        if(Auth::attempt($credentials))
        {
            $user = Auth::user();
            $user->tokens()->delete();
            $token = $user->createToken('api-token')->plainTextToken;
            $user->remember_token = $token;
            $user->save();
            return redirect()->intended('/home');
        }

        return back()->withErrors([
            'error' => 'Invalid id or password',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Prevent CSRF attacks

        return redirect('/');
    }
}

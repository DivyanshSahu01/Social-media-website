<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Crypt;
use App\Mail\RegisterMail;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Cache;

class MailController extends Controller
{
    //
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        
        $email = $request->input('email');
        $name = $request->input('name');
        $password = $request->input('password');
        $otp = rand(111111, 999999);

        $exists = User::where('email', $email)->exists();
        if($exists)
        {
            return response()->json(['error'=>'Email already exists'], 500);
        }

        Cache::put($otp, ['email'=>$email, 'name'=>$name, 'password'=>$password], 300);

        $mail = Mail::to($email)->send(new RegisterMail($name, $otp));
        return response()->json(['message'=>'Mail sent successfully'], 200);
    }

    public function resetPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => __($status)], 200)
            : response()->json(['error' => __($status)], 400);
    }
}
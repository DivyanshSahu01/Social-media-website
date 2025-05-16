<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use Cache;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $userDetails = Cache::pull($request->input('OTP'));
        if($userDetails != null)
        {
            $user = User::create([
                'name'=>$userDetails['name'],
                'email'=>$userDetails['email'],
                'password'=>Hash::make($userDetails['password'])
            ]);

            $api_token = $user->createToken('api-token')->plainTextToken;
            Auth::login($user);
            session(['api_token' => $api_token]);
            return response()->json(['redirect'=>'/home'], 200);
        }

        return response()->json(['error'=>'Invalid otp'], 500);
    }

    public function edit(Request $request)
    {
        $user = $request->user();
        $user->update($request->all());
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $fileExtension = $image->extension();
            $path = $image->storeAs('user', $user->id.".".$fileExtension, 'public');

            $user->image = "storage/".$path;
        }

        $user->save();
    }
    
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return response()->json(['message' => __('passwords.reset')." Redirecting to login page"], 200);
    }

    public function updatePassword(Request $request)
    {
        $user = $request->user();
        $oldPassword = $request->input('oldPassword');
        $newPassword = $request->input('newPassword');

        if(Hash::check($oldPassword, $user->password))
        {
            $user->password = Hash::make($newPassword);
            $user->save();
            return response()->json(['message'=>'Password updated successfully'], 200);
        }
        return response()->json(['error'=>'Invalid old password'], 500);
    }

    public function listFriends(Request $request)
    {
        $user = $request->user();
        $users = User::where('id', '<>', $user->id)->get();
        return response()->json($users);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(['email'=>'required', 'password'=>'required']);
        if(Auth::attempt($credentials))
        {
            $user = Auth::user();
            $user->tokens()->delete();
            $api_token = $user->createToken('api-token')->plainTextToken;
            $user->save();
            session(['api_token' => $api_token]);
            return response()->json(['redirect'=>'/home'], 200);
        }

        return response()->json(['error' => 'Invalid credentials'], 500);
    }

    public function googleOAuth(Request $request)
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Check if user already exists
        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {
            // If not, create a new user
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(Str::random(16)), // just a placeholder
            ]);
        }

        if($user->attributes['image'] == null)
        {
            $user->image = $googleUser->getAvatar();
            $user->save();
        }

        $user->tokens()->delete();
        $api_token = $user->createToken('api-token')->plainTextToken;
        Auth::login($user);
        session(['api_token' => $api_token]);
        return redirect('/home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Prevent CSRF attacks

        return redirect('/');
    }
}

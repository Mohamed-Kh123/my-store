<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Trait\HttpResponses;
use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    use HttpResponses;

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'device_name' => 'required',
            'password' => 'required',
            'abilites' => 'required',
        ]);

        $user = User::where('email', $request->username)->orWhere('phone_number', $request->username)->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return $this->error(null, 'Credentials error ...', 401);
        }
        $abilites = $request->input('abilites', ['*']);
        if($abilites && is_string($abilites)){
            $abilites = explode(',', $abilites);
        }
        
        return $this->success([
            'user' => $user,
            'token' => $user->createToken($request->device_name, $abilites)->plainTextToken,
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => ['required','confirmed', 'password'],
            'phone_number' => 'required|max:255',
            'device_name' => 'required|max:255'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken($request->device_name)->plainTextToken,
        ], '', 201);
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            'message' => 'You have successfully been logged out',
        ]);
    }
}

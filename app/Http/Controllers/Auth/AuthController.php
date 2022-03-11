<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\NewUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'cpf' => 'required|string|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required', 'confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->cpf = $request->cpf;
        $user->phone = $request->phone ?? "";
        $user->password = Hash::make($request->password);
        $user->save();

        $message = [
            'name' => $request->name,
            'password' => $request->password,
            'email' => $request->email,
        ];

        Mail::to($request->email)->send(new NewUser($message));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

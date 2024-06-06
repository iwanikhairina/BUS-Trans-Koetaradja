<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view("signup");
    }

    public function showRegisterNext(Request $request)
    {
        $dataDiri = [
            "nama" => $request->nama,
            "ttl" => $request->ttl,
            "alamat" => $request->alamat,
            "email" => $request->email,
        ];

        return view("signup-next", [
            "data_diri" => $dataDiri,
        ]);
    }

    public function register(Request $request)
    {
        $dataRegister = [
            "name" => $request->nama,
            "ttl" => $request->ttl,
            "alamat" => $request->alamat,
            "email" => $request->email,
            "username" => $request->username,
            "password" => $request->password,
            "role" => "User",
        ];
        User::create($dataRegister);
        return redirect()->route("register.successfully");
    }

    public function registerSuccessfully()
    {
        return view("successfully-register");
    }

    public function showLogin()
    {
        return view("signin");
    }

    public function login(Request $request)
    {
        $user = User::firstWhere("username", $request->username);
        if ($user) {
            $password = $user->password;
            if (password_verify($request->password, $password)) {
                Auth::login($user);
                return redirect()->route("services");
            }
        }
        return back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("services");
    }
}

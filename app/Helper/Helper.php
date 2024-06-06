<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

if (!function_exists("isAdmin")) {
    function isAdmin()
    {
        $user = auth()->user();
        if ($user) {
            $role = $user->role;
            return $role == "Admin";
        }
        return false;
    }
}

if (!function_exists("login")) {
    function login()
    {
        $user = User::find(1);
        Auth::login($user);
        return route("services");
    }
}

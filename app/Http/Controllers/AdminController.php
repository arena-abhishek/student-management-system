<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }
    public function authenticate(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::guard('admin')->attempt(['email' => $req->email, 'password' => $req->password])) {
            echo "ok";
        } else {
            return redirect()->route('admin.login')->with('error', 'Something went wrong');
        }
    }
    public function register()
    {
        $user = new User();
        $user->name = "admin";
        $user->role = "admin";
        $user->email = "admin@gmail.com";
        $user->password = Hash::make('admin');
        return redirect()->route('admin.login')->with('success', 'User created succesfully');

    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function form()
    {
        return view('admin.form');
    }
    public function table()
    {
        return view('admin.table');
    }

}

<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function update(Request $request)
    {
        $users = User::all()->where('email', $request["email"])->first;
        $users = $users->update([
            "name" => $request["username"],
            "email" => $request["email"],
            "role" => $request["role"]
        ]);
        return redirect('/users');
    }
    public function delete(Request $request)
    {
        $users = User::all()->where('email', $request["email"])->first;
        $users = $users->delete();
        return redirect('/users');
    }

    protected function register(Request $data)
    {
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);
        $users = User::all();
        return view('users.index', compact('users'));
    }



}


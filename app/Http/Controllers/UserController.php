<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'userid' => 'required|unique:users',
            'name' => 'required',
            'password' => 'required|min:3',
            'role_id' => 'required|exists:roles,id',
        ]);

        User::create([
            'userid' => $request->userid,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return response()->json(['message' => 'User created successfully.']);
    }

    public function index()
    {
        return User::with('role')->get();
    }
}

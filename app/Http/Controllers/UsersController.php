<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('superadmin.usersData.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('superadmin.usersData.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'role_id' => 'required|integer',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('superadmin.usersData.index')->with('success', 'User updated successfully.');
    }
}
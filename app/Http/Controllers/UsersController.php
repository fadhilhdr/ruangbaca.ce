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

    public function edit($userid)
    {
        $user = User::findOrFail($userid);
        return view('superadmin.usersData.edit', compact('user'));
    }

    public function update(Request $request, $userid)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'role_id' => 'required|integer',
        ]);

        $user = User::findOrFail($userid);
        $user->update([
            'name'    => $request->name,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('superadmin.users.index')->with('success', 'User updated successfully.');
    }
}
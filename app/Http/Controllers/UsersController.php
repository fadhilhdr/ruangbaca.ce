<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('userid', 'like', "%{$search}%");
        })->paginate(10);

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
        Alert::success('Berhasil!', 'Role pengguna berhasil diperbaharui!');

        return redirect()->route('superadmin.users.index');
    }
    public function destroy($userid)
    {
        $user = User::findOrFail($userid);

        // Hapus pengguna
        $user->delete();

        // Tampilkan alert sukses
        Alert::success('Berhasil!', 'Pengguna berhasil dihapus.');
        return redirect()->route('superadmin.users.index');
    }

}
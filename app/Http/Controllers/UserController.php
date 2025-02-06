<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar user.
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Menampilkan form edit user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Menyimpan perubahan user.
     */

    /**
 * Menampilkan form edit role user.
 */
public function editUserRoles($id)
{
    $user = User::findOrFail($id);
    $roles = Role::all();
    return view('users.edit-roles', compact('user', 'roles'));
}

/**
 * Menyimpan perubahan role user.
 */
public function updateUserRoles(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'roles' => 'array'
    ]);

    $user->syncRoles($request->roles ?? []);

    return redirect()->route('users.index')->with('success', 'Role user berhasil diperbarui.');
}


    /**
     * Menghapus user.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}

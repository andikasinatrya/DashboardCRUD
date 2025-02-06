<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Response;

class RoleController extends Controller
{
    /**
     * Menampilkan daftar role.
     */
    public function index()
    {
        $roles = Role::with('permissions')->paginate(10);
        return view('roles.index', compact('roles'));
    }

    /**
     * Menampilkan form untuk membuat role baru.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Menyimpan role baru ke database.
     */
    public function store(Request $request)
    {
        if (Role::where('name', $request->name)->exists()) {
            return Response::make('Role already exists', 403);
        }

        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'array'
        ]);

        $role = Role::create(['name' => $request->name]);

        if ($request->has('permissions')) {
            foreach ($request->permissions as $permissionId) {
                $permission = Permission::find($permissionId);
                if (!$permission) {
                    return Response::make('Permission not found', 403);
                }
            }
            $role->syncPermissions($request->permissions);
        }

        return redirect()->route('roles.index')->with('success', 'Role berhasil dibuat.');
    }

    /**
     * Menampilkan form edit role.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('roles.edit', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Menyimpan perubahan role.
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
    
        if ($role->name !== $request->name && Role::where('name', $request->name)->exists()) {
            return Response::make('Role already exists', 403);
        }
    
        $request->validate([
            'name' => "required|string|unique:roles,name,$id",
            'permissions' => 'array'
        ]);
    
        $role->update(['name' => $request->name]);
    
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->pluck('id')->toArray();
    
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions([]);
        }
    
        return redirect()->route('roles.index')->with('success', 'Role berhasil diperbarui.');
    }
    

    /**
     * Menampilkan detail role.
     */
    public function show($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        return view('roles.show', compact('role'));
    }

    /**
     * Menghapus role.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if ($role->users()->count() > 0) {
            return Response::make('Role is assigned to users, cannot delete', 403);
        }

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus.');
    }
}

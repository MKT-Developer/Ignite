<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show form to create role.
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store new role.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:roles,name',
            ],
            'permissions' => [
                'nullable',
                'array',
            ],
            'permissions.*' => [
                'exists:permissions,name',
            ],
        ]);


        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        $role->syncPermissions(
            $request->permissions ?? []
        );

        return redirect()
            ->route('roles.index')
            ->with('success', 'Rol creado correctamente.');
    }

    /**
     * Show form to edit role.
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();

        return view('roles.edit', compact(
            'role',
            'permissions'
        ));
    }

    /**
     * Update role.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:roles,name,' . $role->id,
            ],
            'permissions' => [
                'nullable',
                'array',
            ],
            'permissions.*' => [
                'exists:permissions,name',
            ],
        ]);

        // Evitar modificar el rol principal
        if (
            $role->name === 'super admin' &&
            $request->name !== 'super admin'
        ) {
            return redirect()
                ->route('roles.index')
                ->with(
                    'error',
                    'El rol Super Admin no puede cambiar de nombre.'
                );
        }

        $role->update([
            'name' => $request->name,
        ]);

        if ($role->name === 'super admin') {

            $role->syncPermissions(
                Permission::all()
            );
        } else {

            $role->syncPermissions(
                $request->permissions ?? []
            );
        }

        return redirect()
            ->route('roles.index')
            ->with('success', 'Rol actualizado correctamente.');
    }

    /**
     * Delete role.
     */
    public function destroy(Role $role)
    {
        if ($role->name === 'super admin') {
            return redirect()
                ->route('roles.index')
                ->with(
                    'error',
                    'El rol Super Admin no puede eliminarse.'
                );
        }

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with(
                'success',
                'Rol eliminado correctamente.'
            );
    }
}

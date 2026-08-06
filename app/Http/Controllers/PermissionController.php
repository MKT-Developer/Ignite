<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    /**
     * Display permissions list.
     */
    public function index()
    {
        $permissions = Permission::all();

        return view(
            'permissions.index',
            compact('permissions')
        );
    }


    /**
     * Show create form.
     */
    public function create()
    {
        return view('permissions.create');
    }


    /**
     * Store permission.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:permissions,name',
            ],
        ]);


        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);


        return redirect()
            ->route('permissions.index')
            ->with(
                'success',
                'Permiso creado correctamente.'
            );
    }


    /**
     * Show edit form.
     */
    public function edit(Permission $permission)
    {
        return view(
            'permissions.edit',
            compact('permission')
        );
    }


    /**
     * Update permission.
     */
    public function update(
        Request $request,
        Permission $permission
    ) {

        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:permissions,name,' . $permission->id,
            ],
        ]);


        $permission->update([
            'name' => $request->name,
        ]);


        return redirect()
            ->route('permissions.index')
            ->with(
                'success',
                'Permiso actualizado correctamente.'
            );
    }


    /**
     * Delete permission.
     */
    public function destroy(Permission $permission)
    {

        if ($permission->roles()->count() > 0) {

            return redirect()
                ->route('permissions.index')
                ->with(
                    'error',
                    'No se puede eliminar un permiso asignado a roles.'
                );
        }


        $permission->delete();


        return redirect()
            ->route('permissions.index')
            ->with(
                'success',
                'Permiso eliminado correctamente.'
            );
    }
}

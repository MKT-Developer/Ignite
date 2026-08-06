<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with([
            'roles',
            'status'
        ])->get();

        return view('users.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        $statuses = Status::all();

        return view('users.create', compact(
            'roles',
            'statuses'
        ));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'last_name' => [
                'nullable',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20'
            ],

            'password' => [
                'required',
                'string',
                'min:8'
            ],

            'status_id' => [
                'required',
                'exists:statuses,id'
            ],

            'role' => [
                'required',
                'string',
                'exists:roles,name'
            ],
        ]);

        DB::transaction(function () use ($request, &$user) {

            $user = User::create([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'status_id' => $request->status_id,
            ]);

            $user->assignRole($request->role);
        });

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuario creado correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        $roles = Role::all();
        $statuses = Status::all();


        return view('users.edit', compact(
            'user',
            'roles',
            'statuses'
        ));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([

            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'last_name' => [
                'nullable',
                'string',
                'max:255'
            ],

            'email' => [
                'required',
                'email',
                "unique:users,email,{$id}"
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20'
            ],

            'password' => [
                'nullable',
                'string',
                'min:8'
            ],

            'status_id' => [
                'required',
                'exists:statuses,id'
            ],

            'role' => [
                'required',
                'string',
                'exists:roles,name'
            ],

        ]);


        $user = User::findOrFail($id);


        $user->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status_id' => $request->status_id,
        ]);


        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        if (
            $user->hasRole('super admin') &&
            $request->role !== 'super admin'
        ) {
            return back()->with(
                'error',
                'No puedes quitar el rol de Super Admin.'
            );
        }

        $user->syncRoles($request->role);


        return redirect()
            ->route('users.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->hasRole('super admin')) {
            return redirect()
                ->route('users.index')
                ->with(
                    'error',
                    'No se puede eliminar a un Super Admin.'
                );
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with(
                'success',
                'Usuario eliminado correctamente.'
            );
    }
}

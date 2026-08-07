<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Status;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with([
            'roles',
            'status'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Búsqueda general
        |--------------------------------------------------------------------------
        */
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('employee_number', 'like', "%{$search}%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Filtro por país
        |--------------------------------------------------------------------------
        */
        if ($request->filled('country')) {

            $query->where(
                'country',
                $request->country
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Filtro por estado
        |--------------------------------------------------------------------------
        */
        if ($request->filled('status_id')) {
            $query->where(
                'status_id',
                $request->status_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Filtro por rol
        |--------------------------------------------------------------------------
        */
        if ($request->filled('role')) {

            $query->whereHas(
                'roles',
                function ($q) use ($request) {

                    $q->where(
                        'name',
                        $request->role
                    );
                }
            );
        }

        $users = $query
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Datos para filtros
        |--------------------------------------------------------------------------
        */
        $countries = User::whereNotNull('country')
            ->distinct()
            ->orderBy('country')
            ->pluck('country');

        $statuses = Status::all();

        $roles = Role::orderBy('name')
            ->get();

        return view('users.index', compact(
            'users',
            'countries',
            'statuses',
            'roles'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $roles = Role::all();
        $roles = Role::whereNot('name', 'super admin')->get();
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
            'employee_number' => [
                'nullable',
                'string',
                'unique:users'
            ],

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

            'country' => [
                'nullable',
                'string',
                'max:100'
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

        $user = null;

        DB::transaction(function () use ($request, &$user) {

            $user = User::create([
                'employee_number' => $request->employee_number,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'country' => $request->country,
                'password' => $request->password,
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

        // $roles = Role::whereNot('name', 'super admin')->get();
        if ($user->hasRole('super admin')) {
            $roles = Role::where('name', 'super admin')->get();
        } else {
            $roles = Role::whereNot('name', 'super admin')->get();
        }
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
            'employee_number' => [
                'nullable',
                'string',
                "unique:users,employee_number,{$id}"
            ],

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

            'country' => [
                'nullable',
                'string',
                'max:100'
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

        if (
            $user->hasRole('super admin') &&
            $request->role !== 'super admin'
        ) {
            return back()->with(
                'error',
                'No puedes quitar el rol de Super Admin.'
            );
        }

        $user->update([
            'employee_number' => $request->employee_number,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'country' => $request->country,
            'status_id' => $request->status_id,
        ]);


        if ($request->filled('password')) {
            $user->update([
                'password' => $request->password
            ]);
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

        if (
            $user->hasRole('super admin') &&
            auth()->id() !== $user->id
        ) {
            return redirect()
                ->route('users.index')
                ->with(
                    'error',
                    'No puedes eliminar otro Super Admin.'
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

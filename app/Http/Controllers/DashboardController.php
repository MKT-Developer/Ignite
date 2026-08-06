<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Status;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [

            'currentUser' => auth()->user(),

            'usersCount' => User::count(),

            'rolesCount' => Role::count(),

            'permissionsCount' => Permission::count(),

            'activeUsersCount' => User::whereHas('status', function ($query) {
                $query->where('name', config('users.default_status'));
            })->count(),

            'statusesCount' => Status::count(),

        ]);
    }
}

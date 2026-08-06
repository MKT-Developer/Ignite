<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Status;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }


    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
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
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults()
            ],
        ]);

        $statusActive = Status::firstWhere(
            'name',
            config('users.default_status')
        );

        $userRole = Role::firstWhere(
            'name',
            config('users.default_role')
        );

        if (! $statusActive || ! $userRole) {
            abort(
                500,
                'No existe el rol o estado configurado en config/users.php. Ejecuta los seeders o revisa la configuración.'
            );
        }

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status_id' => $statusActive->id,
        ]);

        $user->assignRole($userRole);

        if (config('users.email_verification')) {
            event(new Registered($user));

            Auth::login($user);

            return redirect()->route('verification.notice');
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

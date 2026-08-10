<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\DashboardController;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    /** @var User $user */ $user = Auth::user();
    if ($user->hasRole('user')) {
        return redirect()->route('portal');
    }
    if ($user->hasAnyRole(['admin', 'super admin'])) {
        return redirect()->route('dashboard');
    }
    Auth::logout();
    return redirect()->route('login');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'role:super admin|admin'])->name('dashboard');

//Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    // SUPER ADMIN + ADMIN -> Admin Panel 
    Route::middleware(['role:super admin|admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
        Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity.logs.index');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/portal', function () {
        return view('portal.index');
    })->name('portal');
});
require __DIR__ . '/auth.php';

Route::get('/language/{locale}', function ($locale) {

    if ($locale === 'auto') {
        session()->forget('locale');

        return redirect()->back();
    }

    if (! in_array($locale, ['es', 'en'], true)) {
        abort(404);
    }

    session(['locale' => $locale]);

    return redirect()->back();
})->name('language.switch');

// Route::get('/', function () {
//     return view('auth.login');
// })->middleware('guest')->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/', function () {
//     return redirect()->route('login');
// })
//     ->middleware('guest')
//     ->name('home');

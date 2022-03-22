<?php

use App\Http\Controllers\Admin\BooksController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleSocialiteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// if (Auth::guard('admin')->check()) {
//     Route::middleware(['auth',])->group(function () {
//         Route::get('/dashboard', [IndexController::class, 'index'])->name('dashboard');
//     });
// } elseif (Auth::guard('user')->check()) {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->middleware(['auth'])->name('dashboard');
// }

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
Route::get('callback/google', [GoogleSocialiteController::class, 'handleCallback']);


Route::middleware(['auth', 'role:super_admin'])->name('admin.')->prefix('admin')->group(function () {
    //Admin index Route=>
    Route::get('/', [IndexController::class, 'index'])->name('index');
    //Roles Routes=>
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions'); //givePermission function on RoleController
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke'); //revokePermission function on RoleController
    //Permissions Routes=>
    Route::resource('/permissions', PermissionController::class);
    Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
    Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');
    //Users Routes=>
    Route::resource('/users', UserController::class);
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles');
    Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
    Route::post('/users/{user}/permissions', [UserController::class, 'givePermission'])->name('users.permissions');
    Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])->name('users.permissions.revoke');
    //Products Routes=>
    Route::resource('/products', ProductController::class);

    //Book Routes=>
    Route::resource('/books', BooksController::class);
});

require __DIR__ . '/auth.php';
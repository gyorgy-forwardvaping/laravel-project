<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/posts', [App\Http\Controllers\PostController::class, 'index'])->name('posts');
//model binding. insted of the variable the model passed over
Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post');

//auth route

Route::middleware('auth')->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/admin/posts', [App\Http\Controllers\PostController::class, 'list'])->name('post.list');
    Route::post('/admin/posts', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::get('/admin/posts/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');

    Route::get('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::delete('/admin/posts/{post}/delete', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');
    Route::patch('/admin/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
    Route::delete('admin/users/{user}/destroy', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::middleware(['role:admin', 'auth'])->group(function () {
    Route::get('admin/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
    Route::put('admin/users/{user}/attach', [App\Http\Controllers\UserController::class, 'attachRole'])->name('user.role.attach');
    Route::put('admin/users/{user}/detach', [App\Http\Controllers\UserController::class, 'detachRole'])->name('user.role.detach');

    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::delete('/roles/{role}/destroy', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/roles/{role}/show', [App\Http\Controllers\RoleController::class, 'show'])->name('roles.show');
    Route::put('/roles/{role}/update', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
    Route::put('/roles/{role}/attach', [App\Http\Controllers\RoleController::class, 'attach'])->name('roles.permission.attach');
    Route::put('/roles/{role}/detach', [App\Http\Controllers\RoleController::class, 'detach'])->name('roles.permission.detach');

    Route::get('/permissions', [App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
    Route::post('/permissions', [App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
    Route::delete('/permissions/{permission}/destroy', [App\Http\Controllers\PermissionController::class, 'destroy'])->name('permissions.destroy');
    Route::get('/permissions/{permission}/show', [App\Http\Controllers\PermissionController::class, 'show'])->name('permissions.show');
    Route::put('/permissions/{permission}/show', [App\Http\Controllers\PermissionController::class, 'update'])->name('permissions.update');
});

Route::middleware(['auth', 'can:view,user'])->group(function () {
    Route::get('/admin/users/{user}/profile', [App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');
    Route::put('/admin/users/{user}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');
});

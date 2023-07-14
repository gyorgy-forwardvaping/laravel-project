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
});

Route::middleware(['auth', 'can:view,user'])->group(function () {
    Route::get('/admin/users/{user}/profile', [App\Http\Controllers\UserController::class, 'show'])->name('user.profile.show');
    Route::put('/admin/users/{user}/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.profile.update');
});

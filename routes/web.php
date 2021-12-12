<?php

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

Route::get('/', function () {
	return view('welcome');
});

Route::prefix('user')->as('user.')->group(function () {
	Route::get('/register', [\App\Http\Controllers\Auth\User\RegisteredUserController::class, 'create'])->middleware('guest')->name('register');

	Route::post('/register', [\App\Http\Controllers\Auth\User\RegisteredUserController::class, 'store'])->middleware('guest');

	Route::get('/login', [\App\Http\Controllers\Auth\User\AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');

	Route::post('/login', [\App\Http\Controllers\Auth\User\AuthenticatedSessionController::class, 'store'])->middleware('guest');

	Route::post('/logout', [\App\Http\Controllers\Auth\User\AuthenticatedSessionController::class, 'destroy'])->middleware('auth:user')->name('logout');

	Route::get('/dashboard', function () {
		return view('auth.user.dashboard');
	})->middleware(['auth:user'])->name('dashboard');
});

Route::prefix('admin')->as('admin.')->group(function () {
	Route::get('/register', [\App\Http\Controllers\Auth\Admin\RegisteredAdminController::class, 'create'])->middleware('guest')->name('register');

	Route::post('/register', [\App\Http\Controllers\Auth\Admin\RegisteredAdminController::class, 'store'])->middleware('guest');

	Route::get('/login', [\App\Http\Controllers\Auth\Admin\AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');

	Route::post('/login', [\App\Http\Controllers\Auth\Admin\AuthenticatedSessionController::class, 'store'])->middleware('guest');

	Route::post('/logout', [\App\Http\Controllers\Auth\Admin\AuthenticatedSessionController::class, 'destroy'])->middleware('auth:admin')->name('logout');

	Route::get('/dashboard', function () {
		return view('auth.admin.dashboard');
	})->middleware(['auth:admin'])->name('dashboard');
});
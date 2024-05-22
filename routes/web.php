<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('keto.index');
});

Route::get('/sneat', function(){
    return view('sneat.index');
});

Route::get('/keto', function(){
    return view('keto.index');
});

/**
 * TODO: setting up the routes for the user side
 */
    Route::get('/user', [UsersController::class, 'login'])->name('usersLogin');
    Route::get('/user/register', [UsersController::class, 'register'])->name('usersRegister');
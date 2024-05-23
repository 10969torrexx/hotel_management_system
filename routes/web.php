<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleSignInController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\RoomsController;
use Illuminate\Support\Facades\Auth;

Auth::routes();
/**
 * TODO: these are simply for testing purposes
 */
    Route::get('/sneat', function(){
        return view('sneat.index');
    });

    Route::get('/keto', function(){
        return view('keto.index');
    });

/**
 * TODO: handling google login
 */
    Route::post('/google/signin', [GoogleSignInController::class, 'store'])->name('googleSignIn');
    
/**
 * TODO: handling email routes
 */
    Route::get('/email/{email}', [EmailController::class, 'index'])->name('emailIndex');

/**
 * TODO: creating throttle or rate limetter
 */
    Route::middleware(['throttle:5,1'])->group(function () {
        Route::post('/email/verify', [EmailController::class, 'verify'])->name('emailVerify');
        Route::post('/login', [UsersController::class, 'confirmLogin'])->name('usersLoginConfirm');
    });
/**
 * TODO: setting up the routes for the user side
 */
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/user', [UsersController::class, 'login'])->name('usersLogin');
    Route::get('/user/register', [UsersController::class, 'register'])->name('usersRegister');
    Route::post('/user/store', [UsersController::class, 'store'])->name('usersStore');
    Route::get('/user/home', [HomeController::class, 'home'])->name('usersHome');
    
/**
 * TODO: setting up the routes for the admin side
 */
    Route::get('/admin', [AdminController::class, 'login'])->name('adminLogin');
    Route::get('/admin/register', [AdminController::class, 'register'])->name('adminRegister');
    
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::get('/home', [AdminController::class, 'index'])->name('adminHome');
        Route::get('/logout', [AdminController::class, 'logout'])->name('adminLogout');

        Route::get('/rooms', [RoomsController::class, 'index'])->name('roomsIndex');
        Route::get('/rooms/add', [RoomsController::class, 'add'])->name('roomsAdd');
        Route::post('/rooms/store', [RoomsController::class, 'store'])->name('roomsStore');
        Route::get('/rooms/delete/{id}', [RoomsController::class, 'destroy'])->name('roomsDelete');
        Route::post('/rooms/update', [RoomsController::class, 'update'])->name('roomsUpdate');
        Route::get('/rooms/show}', [RoomsController::class, 'show'])->name('roomsShow');
    });
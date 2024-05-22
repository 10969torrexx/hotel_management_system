<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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
 * TODO: setting up the routes for the user side
 */
    Route::get('/', function () {
        return view('keto.index');
    });
    Route::get('/user', [UsersController::class, 'login'])->name('usersLogin');
    Route::get('/user/register', [UsersController::class, 'register'])->name('usersRegister');
    
    Route::get('/user/home', [HomeController::class, 'home'])->name('usersHome');
    Route::get('/user/about', [HomeController::class, 'About'])->name('usersAbout');
    Route::get('/user/rooms', [HomeController::class, 'our_room'])->name('usersRooms');
    Route::get('/user/gallery', [HomeController::class, 'gallery'])->name('usersGallery');
    Route::get('/user/blog', [HomeController::class, 'blog'])->name('usersBlog');
    Route::get('/user/contact', [HomeController::class, 'contact_us'])->name('usersContact');
    
/**
 * TODO: setting up the routes for the admin side
 */
    Route::get('/admin', [AdminController::class, 'login'])->name('adminLogin');
    Route::get('/admin/register', [AdminController::class, 'register'])->name('adminRegister');
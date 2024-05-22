<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleSignInController;
use App\Http\Controllers\EmailController;
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
    Route::post('/email/verify', [EmailController::class, 'index'])->name('emailVerify');

/**
 * TODO: setting up the routes for the user side
 */
    Route::get('/', function () {
        return view('keto.index');
    });
    Route::get('/user', [UsersController::class, 'login'])->name('usersLogin');
    Route::get('/user/register', [UsersController::class, 'register'])->name('usersRegister');
    Route::post('/user/store', [UsersController::class, 'store'])->name('usersStore');
    
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
    
    // Route::group(['prefix' => 'user', 'middleware' => 'auth'], function () {
    //     Route::get('/', [UsersController::class, 'login'])->name('usersLogin');
    //     Route::get('/register', [UsersController::class, 'register'])->name('usersRegister');
        
    //     Route::get('/home', [HomeController::class, 'home'])->name('usersHome');
    //     Route::get('/about', [HomeController::class, 'About'])->name('usersAbout');
    //     Route::get('/rooms', [HomeController::class, 'our_room'])->name('usersRooms');
    //     Route::get('/gallery', [HomeController::class, 'gallery'])->name('usersGallery');
    //     Route::get('/blog', [HomeController::class, 'blog'])->name('usersBlog');
    //     Route::get('/contact', [HomeController::class, 'contact_us'])->name('usersContact');
    // });
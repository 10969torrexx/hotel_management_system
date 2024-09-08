<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GoogleSignInController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\SessionsController;
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
    Route::middleware(['throttle:4,1'])->group(function () {
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

    Route::post('/setSessionData', [SessionsController::class, 'store'])->name('sessionStore');

    Route::group(['middleware' => 'auth', 'user'], function () {
        Route::post('chat/send', [ChatsController::class, 'store'])->name('sendMessage');
        Route::get('reservation', [ReservationsController::class, 'index'])->name('reservationIndex');
        Route::get('reservation/make', [ReservationsController::class, 'make'])->name('reservationMake');
        Route::post('reservation/make', [ReservationsController::class, 'makeReservation'])->name('reservationMake');
        Route::get('reservation/my', [ReservationsController::class, 'myReservations'])->name('reservationMy');
        Route::get('/reservation/extend/', [ReservationsController::class, 'reservationExtend'])->name('reservationExtendOrCheckout');

        Route::get('/find/rooms', [ReservationsController::class, 'find'])->name('usersFindRooms');
        Route::get('/reservations/extendt', [ReservationsController::class, 'forReservationExtend'])->name('forReservationExtend');
    });

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

        Route::get('chat/get/', [ChatsController::class, 'get'])->name('getMessage');
        Route::get('chat/index', [ChatsController::class, 'index'])->name('chatIndex');
        Route::get('chat/show', [ChatsController::class, 'show'])->name('chatShow');
        Route::post('chat/reply', [ChatsController::class, 'reply'])->name('chatReply');
        Route::get('chat/outbox', [ChatsController::class, 'outbox'])->name('chatOutbox');
        Route::get('chat/delete', [ChatsController::class, 'delete'])->name('chatDelete');

        Route::get('reservation/pending', [ReservationsController::class, 'pending'])->name('reservationPending');
        Route::get('reservation/acceppt', [ReservationsController::class, 'accepted'])->name('reservationAccept');
        Route::get('reservation/declined', [ReservationsController::class, 'declined'])->name('reservationDecline');
        Route::get('reservation/logs', [ReservationsController::class, 'logs'])->name('reservationLogs');
    });
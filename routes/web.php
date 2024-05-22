<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('keto.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/sneat', function(){
    return view('sneat.index');
});
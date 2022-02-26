<?php

use Illuminate\Support\Facades\Route;





// Home Route
Route::get('/', function () {
    return view('Client-Welcome');
});

// Admin Routes
Route::get("/admin", function(){
    return view("admin.views.home"); 
}); 

// Default fallback 
Route::fallback(function(){
    return view("Client-Fallback"); 
}); 

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<?php

use Illuminate\Support\Facades\Route;


// Client Routes 
Route::get('/', function () {
    return view("Client-Welcome"); 
});



// Admin routes
Route::get("/admin", function(){
    return view("admin.views.home"); 
}); 

Route::fallback(function(){
    return view("Client-Fallback"); 
}); 

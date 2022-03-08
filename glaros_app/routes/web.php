<?php

use App\myclass\Content;
use Illuminate\Support\Facades\Route;

$con = new Content(); 


// Home Route
Route::get('/', function () {
    return view("error.404");
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


Route::get("/test", function(){
    // Menue configuration and settings
    $path = base_path()."/resources/config/"; 
    $con = new Content(); 
    $allModels =  $con->models($path); 


    //Settings by categories
    $menus = []; 
    $site = []; 

    // Menus 
    foreach( $allModels as $i){
        if($i["model"]== "settings"){
            $menus = $i["data"]->menus; 
        } 
    }


    return view("client.index")->with(["menus"=>$menus]); 
}); 

Route::get("/model", function(){
    $path = base_path()."/resources/config/"; 
    $con = new Content();
    return $con->models($path);  
}); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

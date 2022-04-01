<?php

use App\myclass\Content;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view("error.404");
});

// Admin Routes
Route::get("/admin", function () {
    $con = new Content();
    // fileRead 
    $filePath = base_path() . "/resources/views/client/index.blade.php";
    return view("admin.views.home")->with(["code" => $con->FileRead($filePath)]);
});

// Default fallback 
Route::fallback(function () {
    return view("Client-Fallback");
});

Auth::routes();


Route::get("/test", function () {
    $path = base_path()."/resources/config/"; 
    $content = new Content($path, "products"); 
    
    $fetchData =   json_decode(json_encode($content->get()), true) ; 

    $products = []; 

    foreach($fetchData as $i){
        array_push($products, $i); 
    }


    return view("client.index")->with(["products" =>$products]);
});

Route::get("/models", function () {
    $path = base_path() . "/resources/config/";
    $con = new Content();
    return $con->models($path);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

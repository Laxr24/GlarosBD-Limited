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
    // Menue configuration and settings
    $path = base_path() . "/resources/config/";
    $con = new Content();
    $allModels =  $con->models($path);


    //Settings by categories
    $menus = [];
    $site = [];

    $header_code = "";
    $body_code = "";
    $footer_code = "";

    // Menus 
    foreach ($allModels as $i) {
        if ($i["model"] == "settings") {
            $menus = $i["data"]->menus;
        }
    }


    return view("client.index")->with(["menus" => $menus]);
});

Route::get("/models", function () {
    $path = base_path() . "/resources/config/";
    $con = new Content();
    return $con->models($path);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

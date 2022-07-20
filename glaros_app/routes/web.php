<?php

use App\myclass\Content;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get("/", function () {
    $path = base_path()."/resources/config/"; 
    $content = new Content($path, "products"); 
    
    $fetchData =   json_decode(json_encode($content->get()), true) ; 

    $products = []; 

    foreach($fetchData as $i){
        array_push($products, $i); 
    }


    return view("client.index")->with(["products" =>$products]);
});

Route::get('/dashboard', function () {
    // return response()->json(["name"=>Auth::user()->name, "role"=>Auth::user()->role, "email"=>Auth::user()->email]); 
    // return view('dashboard');
    $con = new Content();
    // fileRead 
    $filePath = base_path() . "/resources/views/client/index.blade.php";
    return view("admin.views.home")->with(["code" => $con->FileRead($filePath)]);
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


// Default fallback 
Route::fallback(function () {
    return view("Client-Fallback");
});


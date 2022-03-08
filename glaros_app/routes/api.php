<?php

use App\myclass\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("/settings", function(){
    $path = base_path()."/resources/config/"; 
    $con = new Content(); 
    $allModels =  $con->models($path); 
    $testObj = []; 
    foreach( $allModels as $i){
        if($i["model"]== "settings"){
            $testObj["site_name"] = $i["data"]->site_name; 
            $testObj["site_tagline"] = $i["data"]->site_tagline; 
        } 
    }
    return $testObj;
}); 
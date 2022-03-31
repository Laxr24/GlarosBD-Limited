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


Route::post("/updateHomepage", function(Request $request){
    // rewritting fiel 
    $path = base_path()."/resources/views/client/index.blade.php";
    $content = new Content(); 
    $data = $request->content; 
    if($data != null || $data != ""){
        $content->rewrite($path, $data); 
    }
    return $content->FileRead($path); 
}); 

Route::post("/addproduct", function(Request $request){

    $file = $request->file('image');
    $file->move(base_path()."/public/client/uploads", $file->getClientOriginalName());
    $newProduct = [
        "name"=>$request->name, 
        "description"=>$request->description, 
        "side"=>$request->side, 
        "image_path"=>"/public/client/uploads/".$file->getClientOriginalName()
    ]; 

    $path = base_path()."/resources/config/";
    $content = new Content($path, "products", []); 

    $content->add($request->name, $newProduct); 

    return response()->json(["response"=>200]); 
}); 
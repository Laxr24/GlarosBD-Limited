<?php

namespace App\Http\Controllers;
use App\myclass\Content;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $con = new Content();
        // fileRead 
        $filePath = base_path() . "/resources/views/client/index.blade.php";
        return view("admin.views.home")->with(["code" => $con->FileRead($filePath)]);
        
    }
}

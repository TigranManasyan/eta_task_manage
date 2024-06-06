<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // return view("home");
        if(Auth::user()->hasRole("admin")) {
            return redirect("/admin");
        } else if(Auth::user()->hasRole("manager")) {
            return redirect("/manager");
        }else if(Auth::user()->hasRole("user")) {
            return redirect("/user");
        }
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index() {
        $tasks = DB::table("user_tasks")->where("user_id", "=", Auth::user()->id)->get();
        $task_count = count($tasks);
        return view("user.index", compact("task_count"));
    }
}

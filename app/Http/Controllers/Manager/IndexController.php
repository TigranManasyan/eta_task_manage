<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{

    public function index() {
        $tasks = Task::where("user_id", "=", Auth::user()->id)->get();
        $users = User::query()
            ->where("id", "<>", Auth::user()->id)
            ->whereHas('roles', function($query) {
                $query->where('name', 'user');
            })
            ->get();
        $task_count = count($tasks);
        $user_count = count($users);
        return view("manager.index", compact("task_count", "user_count"));
    }
}

<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::orderBy("id", "DESC")->paginate(10) ;
        return view("manager.task.index", compact("tasks"));
    }

    public function show($id) {

    }

    public function create() {
        $users = User::query()
            ->whereHas('roles', function($query) {
                $query->where('name', 'user');
            })
            ->get();
        return view("manager.task.create", compact("users"));
    }

    public function store(Request $request) {

    }

    public function getUserTasks($user_id) {

    }

    public function edit($id) {

    }

    public function update(Request $request) {

    }

    public function delete($id) {

    }
}

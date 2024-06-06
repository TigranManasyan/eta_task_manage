<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index() {
        $tasks = DB::table("user_tasks")
            ->join("tasks", "user_tasks.task_id", "=", "tasks.id")
            ->select("tasks.*", "user_tasks.status")
            ->where("user_tasks.user_id", "=", Auth::user()->id)
            ->get();
        return view("user.task.index", compact("tasks"));
    }

    public function show($id) {
        $task = DB::table("user_tasks")
            ->join("tasks", "user_tasks.task_id", "=", "tasks.id")
            ->select("tasks.*", "user_tasks.status")
            ->where("user_tasks.user_id", "=", Auth::user()->id)
            ->where("tasks.id", "=", $id)
            ->get()[0];

        return view("user.task.show", compact('task'));
    }


    public function change_status(Request $request) {
        $task = DB::table("user_tasks")->where("task_id", "=", $request['task_id'])->update([
            "status" => $request['status']
        ]);


        return response()->json([
            'status' => 200,
            'message' => 'Հաջողությամբ թարմացվել է'
        ]);
    }
}

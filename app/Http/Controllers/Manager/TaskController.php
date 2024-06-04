<?php

namespace App\Http\Controllers\Manager;

use Intervention\Image\Facades\Image;
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
        $task = Task::findOrFail($id);
        return view("manager.task.show", compact("task"));
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
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'deadline' => 'required|date',  
            'importance' => 'required|in:low,medium,high',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $images = [];

        if($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $img_ext = $image->getClientOriginalExtension();
                $new_name = time() . "_" . rand(1, 100) . "." . $img_ext;
                $image->move('uploads', $new_name);
                array_push($images, $new_name);
            }
        }


        $task = Task::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'user_id' => $validatedData['user_id'],
            'deadline' => $validatedData['deadline'],
            'importance' => $validatedData['importance'],
            'images' => json_encode($images),
            'status' => 'pending',
        ]);

        return redirect()->route('manager.task.index')->with('success', 'Առաջադրանքը հաջողությամբ ստեղծվել է');
    }
    

    public function getUserTasks($user_id) {

    }

    public function edit($id) {
        $task = Task::findOrFail($id);
        $users = User::query()
            ->whereHas('roles', function($query) {
                $query->where('name', 'user');
            })
            ->get();
        return view("manager.task.edit", compact("task", "users"));
    }
    

    public function update(Request $request, $id) {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'deadline' => 'required|date',  
            'importance' => 'required|in:low,medium,high',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $task = Task::findOrFail($id);
    
        if($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $img_ext = $image->getClientOriginalExtension();
                $new_name = time() . "_" . rand(1, 100) . "." . $img_ext;
                $image->move('uploads', $new_name);
                $images[] = $new_name;
            }
            $task->images = json_encode($images);
        }
    
        $task->title = $validatedData['title'];
        $task->description = $validatedData['description'];
        $task->user_id = $validatedData['user_id'];
        $task->deadline = $validatedData['deadline'];
        $task->importance = $validatedData['importance'];
    
        $task->save();
    
        return redirect()->route('manager.task.index')->with('success', 'Առաջադրանքը հաջողությամբ փոփոխվել է');
    }

    public function destroy($id) {
        $task = Task::findOrFail($id);
        $task->delete();
    
        return redirect()->route('manager.task.index')->with('success', 'Առաջադրանքը հաջողությամբ ջնջվել է');
    }
    
}

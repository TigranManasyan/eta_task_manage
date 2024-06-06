<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function makeRandomPassword($length = 6) {
        $matches = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R',
            'S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s',
            't','u','v','w','x','y','z','!','@','#','$','^','&'];
        $output = '';
        for($i = 1; $i <= $length; $i++) {
            $output .= $matches[rand(0, count($matches) - 1)];
        }

        return $output;
    }
    public function index() {
        $id = Auth::user()->id;

        $users = User::query()
            ->where("id", "<>", $id)
            ->whereHas('roles', function($query) {
                $query->where('name', 'user');
            })
            ->get();

        return view('manager.user.index', compact('users'));
    }

    public function create() {
        return view("manager.user.create");
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4|confirmed',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'created_by' => Auth::user()->id,
        ]);

        $user->assignRole("user");

        return redirect()->route('manager.user.index')->with('success', 'Աշխատակիցը հաջողությամբ ստեղծվել է.');
    }

    public function show($id) {
        $user = User::findOrFail($id);
        return view("manager.user.show", compact("user"));
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return view("manager.user.edit", compact("user"));
    }

    public function update(Request $request ) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:4|confirmed',
        ]);

        $user = User::findOrFail($request->id);


        $user ->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        return redirect()->route('manager.user.index')->with('success', 'Աշխատակիցը հաջողությամբ ստեղծվել է.');
    }

    public function delete($id) {
        $user = User::findOrFail($id);
        $tasks = DB::table('tasks')->where("user_id", "=", $user->id)->get();


        foreach ($tasks as $task) {

            DB::table('user_tasks')->where("task_id", "=", $task->id)->update(['user_id' => Auth::user()->id]);
        }
        $delete = $user->delete();
        if($delete) {
            return redirect()->route('manager.user.index')->with('success', 'Տվյալները հաջողությամբ հեռացվել են');
        }

    }
}

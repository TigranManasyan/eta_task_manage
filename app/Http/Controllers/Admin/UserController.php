<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
                $query->where('name', 'manager');
            })
            ->get();

        return view('admin.user.index', compact('users'));
    }


    public function create() {
        return view("admin.user.create");
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
        ]);

        $user->assignRole("manager");

        return redirect()->route('admin.user.index')->with('success', 'User created successfully.');
    }


    public function edit($id) {
        $user = User::findOrFail($id);
        return view("admin.user.edit", compact("user"));
    }



    public function update(Request $request) {
        $user = User::findOrFail($request->id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:4|confirmed',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User updated successfully.');
    }


    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();


        return redirect()->route('admin.user.index')->with('success', 'User deleted successfully.');
    }
}

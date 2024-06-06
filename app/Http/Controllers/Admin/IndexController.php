<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index() {
        $managers = User::query()
            ->where("id", "<>", Auth::user()->id)
            ->whereHas('roles', function($query) {
                $query->where('name', 'manager');
            })
            ->get();
        $manager_count = count($managers);
        return view("admin.index", compact('manager_count'));
    }
}

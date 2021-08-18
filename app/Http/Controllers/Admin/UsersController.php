<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        // $users = User::query()->with('access')->paginate(10);
        // $users = User::query()->where('access_level', '=' , '1')->with('access')->paginate(10);
        $users = User::query()->where('access_level', '=' , '2')->with('access')->paginate(10);
        // $users = User::query()->where('access_level', '=' , '3')->with('access')->paginate(10);
        return view('admin.users.listing', compact('users'));
    }
}

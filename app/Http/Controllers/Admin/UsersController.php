<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $this->adminAccess();

        $users = User::query()->with('access')->paginate(10);
        return view('admin.users.listing', compact('users'));
    }
}

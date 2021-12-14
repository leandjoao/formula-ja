<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Authenticate;
use App\Models\Budget;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::user()->access_level == 2 || Auth::user()->access_level == 3) {
            return redirect()->route('budgets');
        }

        $data = [
            'users' => User::all()->count(),
            'partners' => Pharmacy::all()->count(),
            'budgets' => Budget::orderBy('created_at', 'asc')->with(['sender', 'answers', 'status'])->limit(5)->get()->toArray()
        ];

        return view('admin.dashboard', compact('data'));
    }
}

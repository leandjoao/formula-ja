<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigsController extends Controller
{
    public function index()
    {
        $configs = Config::query()->first()->toJson();
        return view('admin.configs', compact('configs'));
    }
}

<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SejaUmParceiroController extends Controller
{
    public function parceiro()
    {

        // $terms = Config::select('terms')->first();

        return view('guest.seja-um-parceiro');
    }
}

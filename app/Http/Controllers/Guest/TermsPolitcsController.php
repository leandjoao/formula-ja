<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TermsPolitcsController extends Controller
{
    public function terms()
    {
        return view('guest.termos');
    }

    public function politics()
    {
        return view('guest.politicas');
    }
}

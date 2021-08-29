<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function adminAccess()
    {
        if(Auth::user()->access_level != 1) {
            return abort(403);
        }
    }

    public function pharmacyAccess()
    {
        if(Auth::user()->access_level != 1 || Auth::user()->access_level != 3) {
            return abort(403);
        }
    }
}

<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function newsletter(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'newsletter' => 'email|unique:newsletters,email|required'
        ]);

        if($valid->fails()) return redirect()->back()->withErrors($valid)->withInput();

        $email = new Newsletter();
        $email->email = $request->newsletter;
        $email->save();

        return redirect()->back()->with(['status' => ['text' => 'Seu e-mail foi salvo!', 'icon' => 'success']]);
    }
}

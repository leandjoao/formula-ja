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
            'email' => 'email|unique:newsletters,email|required'
        ]);

        if($valid->fails()) return response()->json($valid->errors(), 500);

        $email = new Newsletter();
        $email->email = $request->email;
        $email->save();

        return response()->json(['message' => "Sucesso! Seu e-mail foi salvo!"]);
    }
}

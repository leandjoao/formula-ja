<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('guest.contact');
    }

    public function send(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        if($valid->fails()) return response()->json($valid->errors(), 500);

        $message = new Contact();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->phone = $request->phone;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->save();

        // Newsletter::query()->findOrNew('',['email' => $request->message]);

        return response()->json(['message' => "Sucesso! Obrigado pelo seu contato."]);
    }
}

<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Guest\ExtraTexts;
use App\Models\Guest\GetInTouch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = GetInTouch::all()->toArray();
        $text = ExtraTexts::select('contact_text')->first()->contact_text;

        return view('guest.contact', compact('contacts', 'text'));
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

        if($valid->fails()) return redirect()->back()->withErrors($valid)->withInput();

        $message = new Contact();
        $message->name = $request->name;
        $message->email = $request->email;
        $message->phone = $request->phone;
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->save();

        return redirect()->back()->with(['status' => ['text' => 'Recebemos o seu contato!', 'icon' => 'success']]);
    }
}

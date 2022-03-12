<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guest\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $faqs = Faq::query()->paginate(10);
        return view('admin.faq.index', compact('faqs'));
    }

    public function new()
    {
        return view('admin.faq.create');
    }

    public function save(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);

        if($valid->fails()) return redirect()->back()->withErrors($valid)->withInput();

        $faq = new Faq();
        $faq->question = Str::ucfirst(Str::lower($request->question));
        $faq->answer = $request->answer;
        $faq->pet = boolval($request->pet);
        $faq->partner = boolval($request->partner);
        $faq->save();

        return redirect()->route('faq')->with(['status' => ['text' => 'Criado!', 'icon' => 'success']]);
    }

    public function remove($id)
    {
        Faq::query()->where('id', $id)->delete();
        return redirect()->route('faq')->with(['status' => ['text' => 'Removido!', 'icon' => 'success']]);
    }

    public function edit($id)
    {
        $faq = Faq::query()->where('id', $id)->first();
        return view('admin.faq.edit', compact('faq'));
    }

    public function editSave(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'question' => 'required|string',
            'answer' => 'required|string'
        ]);

        if($valid->fails()) return redirect()->back()->withErrors($valid)->withInput();

        $faq = Faq::query()->where('id', $id)->first();
        $faq->question = Str::ucfirst(Str::lower($request->question));
        $faq->answer = $request->answer;
        $faq->pet = boolval($request->pet) ?? false;
        $faq->partner = boolval($request->partner) ?? false;
        $faq->save();

        return redirect()->route('faq')->with(['status' => ['text' => 'Criado!', 'icon' => 'success']]);
    }
}

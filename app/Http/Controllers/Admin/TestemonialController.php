<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testemonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TestemonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $testemonials = Testemonial::query()->paginate(10);
        return view('admin.testemonials.index', compact('testemonials'));
    }

    public function new()
    {
        return view('admin.testemonials.create');
    }

    public function save(Request $request)
    {
        $valid = Validator::make($request->all(), [
            "name" => "required",
            "business" => "required",
            "title" => "required",
            "testemonial" => "required",
            "avatar" => "file|mimes:png,jpg,jpeg|max:1024"
        ]);

        if($valid->fails()) return redirect()->back()->with(['status' => ['text' => 'Verifique as informações!', 'icon' => 'error']]);

        if($request->file('avatar')) {
            $fileName = Str::random(64) .'.'. Str::lower($request->file('avatar')->extension());
            $request->file('avatar')->storeAs("public/testemonials/", $fileName);
        }

        $testemonial = new Testemonial();
        $testemonial->name = $request->name;
        $testemonial->title = $request->title;
        $testemonial->business = $request->business;
        $testemonial->testemonial = $request->testemonial;
        if($request->file('avatar')) {
            $testemonial->avatar = $fileName;
        } else {
            $testemonial->avatar = 'user.png';
        }
        $testemonial->save();

        return redirect()->route('testemonials')->with(['status' => ['text' => 'Depoimento criado!', 'icon' => 'success']]);
    }

    public function edit($id)
    {
        $testemonial = Testemonial::query()->where('id', $id)->first();
        return view('admin.testemonials.edit', compact('testemonial'));
    }

    public function editSave(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            "name" => "required",
            "business" => "required",
            "title" => "required",
            "testemonial" => "required",
            "avatar" => "file|mimes:png,jpg,jpeg|max:1024"
        ]);

        if($valid->fails()) return redirect()->back()->withErrors($valid)->withInput();

        if($request->file('avatar')) {
            $fileName = Str::random(64) .'.'. Str::lower($request->file('avatar')->extension());
            $request->file('banner')->storeAs("public/testemonials/", $fileName);
        }

        $testemonial = Testemonial::query()->where('id', $id)->first();
        $testemonial->name = $request->name;
        $testemonial->title = $request->title;
        $testemonial->business = $request->business;
        $testemonial->testemonial = $request->testemonial;
        if($request->file('avatar')) {
            $testemonial->avatar = $fileName;
        }
        $testemonial->save();

        return redirect()->route('testemonials')->with(['status' => ['text' => 'Depoimento atualizado!', 'icon' => 'success']]);
    }

    public function remove($id)
    {
        $testemonial = Testemonial::query()->where('id', $id)->first();
        $testemonial->delete();

        return redirect()->route('testemonials')->with(['status' => ['text' => 'Depoimento removido!', 'icon' => 'success']]);
    }
}

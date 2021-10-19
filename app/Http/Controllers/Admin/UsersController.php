<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        $this->adminAccess();

        $users = User::query()->with('access')->paginate(10);
        return view('admin.users.listing', compact('users'));
    }

    public function create(Request $request)
    {
        $this->adminAccess();

        $valid = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone' => 'required',
            'access_level' => 'required|exists:access_levels,id',
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->access_level = $request->access_level;
        $user->save();

        return redirect()->back()->with(['status' => ['text' => 'Usuário criado!', 'icon' => 'success']]);
    }

    public function update(Request $request, $id)
    {
        $this->adminAccess();

        $valid = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'phone' => 'required',
            'access_level' => 'required|exists:access_levels,id',
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->access_level = $request->access_level;
        $user->save();

        return redirect()->back()->with(['status' => ['text' => 'Usuário alterado!', 'icon' => 'success']]);
    }

    public function remove($id)
    {
        $this->adminAccess();

        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with(['status' => ['text' => 'Usuário removido!', 'icon' => 'success']]);
    }
}

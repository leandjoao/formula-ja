<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
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

    public function getUsers(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column'];
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];
        $searchValue = $search_arr['value'];

        // Total records
        $totalRecords = User::select('count(*) as allcount')->count();
        $totalRecordswithFilter = User::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = User::orderBy($columnName,$columnSortOrder)
        ->where('users.name', 'like', '%' .$searchValue . '%')
        ->orWhere('users.email', 'like', '%' .$searchValue . '%')
        ->orWhere('users.phone', 'like', '%' .$searchValue . '%')
        ->select('users.*')
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $data_arr = array();

        foreach($records as $record){
            $id = $record->id;
            $phone = $record->phone;
            $name = $record->name;
            $email = $record->email;
            $since = Carbon::parse($record->created_at)->diffForHumans();
            $al = $record->access_level;

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "phone" => $phone,
                "email" => $email,
                "created_at" => $since,
                "access_level" => $al,
            );
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        return response()->json($response);
    }
}

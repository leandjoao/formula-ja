<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Pharmacy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function index()
    {
        $this->adminAccess();
        $users = User::query()->count();
        return view('admin.users.listing', compact('users'));
    }

    public function showCreate()
    {
        return view('admin.users.create');
    }

    public function create(Request $request)
    {

        $this->adminAccess();
        $valid = Validator::make($request->all(), [
            'cpf' => 'required',
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string',
            'cep' => 'required|string',
            'address' => 'required|string',
            'number' => 'required|string',
            'neighborhood' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make("123456");
        $user->phone = $request->phone;
        $user->cpf = $request->cpf;
        $user->access_level = 2;
        $user->save();

        $address = new Address();
        $address->user_id = $user->id;
        $address->cep = $request->cep;
        $address->name = $request->partnerName ?? $request->name;
        $address->phone = $request->phone;
        $address->address = $request->address;
        $address->neighborhood = $request->neighborhood;
        $address->city = $request->city;
        $address->state = $request->state;
        $address->number = $request->number;
        $address->default = true;
        $address->complement = $request->complement ?? '';
        $address->reference = $request->reference ?? '';
        $address->save();

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

    public function view($id)
    {
        $user = User::query()
        ->where('id', $id)
        ->with(['pharmacy', 'budgets', 'address'])
        ->first()
        ->toArray();

        return view('admin.users.details', compact('user'));
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
        $this->adminAccess();
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
            $name = Str::ucfirst($record->name);
            $email = $record->email;
            $since = Carbon::parse($record->created_at)->diffForHumans();
            $al = Str::ucfirst(DB::select('select label from access_levels where id = '.$record->access_level)[0]->label);

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "phone" => $phone,
                "email" => $email,
                "created_at" => $since,
                "access_level" => $al,
                "actions" => [
                    "view" => route('users.view', $id),
                    "remove" => route('users.remove', $id),
                    ]
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

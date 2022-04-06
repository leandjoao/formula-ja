<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewPartner;
use App\Models\Bank;
use App\Models\Pharmacy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PartnersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => ['showProfile', 'update', 'changeAddress', 'changeLogo']]);
    }

    public function index()
    {
        $partners = Pharmacy::query()->count();
        return view('admin.parceiros.listing', compact('partners'));
    }

    public function showCreate()
    {
        $users = User::query()->where('id', '!=', 1)->get()->toArray();
        $banks = Bank::all()->toArray();

        return view('admin.parceiros.create', compact('users', 'banks'));
    }

    public function create(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'cnpj' => 'required|unique:pharmacies,cnpj',
            'cep' => 'required',
            'number' => 'required',
            'phone' => 'required',
            'owner' => 'required|exists:users,cpf',
            'cod_bank' => 'required',
            'branch' => 'required',
            'account_number' => 'required',
            'account_check_digit' => 'required',
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:1024'
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $user = User::query()->where('cpf', $request->owner)->get()->first();
        $user->access_level = 3;
        $user->save();

        $recipientData = [
            'name' => $request->name,
            'email' => $request->email,
            'cpf' => $request->owner,
            'cod_bank' => $request->cod_bank,
            'branch' => $request->branch,
            'branch_check' => $request->branch_check_digit ?? null,
            'account_number' => $request->account_number,
            'account_digit' => $request->account_check_digit,
            'owner' => $request->owner,
        ];

        $storage = Storage::disk('local');
        $file = $request->file('logo');
        $filename = Str::random(32).'.'.Str::lower($file->getClientOriginalExtension());
        $storagePath = 'public/partners/'.$filename;
        $storage->put($storagePath, file_get_contents($file));

        $pagarme = new PagarmeController();
        $recipient = $pagarme->newRecipient($recipientData);

        $pharmacy = new Pharmacy();
        $pharmacy->name = $request->name;
        $pharmacy->zip_code = $request->cep;
        $pharmacy->street = $request->address;
        $pharmacy->neighborhood = $request->neighborhood;
        $pharmacy->city = $request->city;
        $pharmacy->state = $request->state;
        $pharmacy->number = $request->number;
        $pharmacy->phone = $request->phone;
        $pharmacy->cnpj = $request->cnpj;
        $pharmacy->owner_id = $user->id;
        $pharmacy->pet = boolval($request->pet);
        $pharmacy->recipient_id = $recipient->id;
        $pharmacy->logo = $filename;
        $pharmacy->save();

        $data = [
            'name' => $user->name,
            'partnerName' => $request->name,
            'address' => $request->address.', '.$request->number.', '.$request->neighborhood.' - '.$request->city.'/'.$request->state
        ];

        Mail::to($user->email)->send(new NewPartner($data));

        return redirect()->back()->with(['status' => ['text' => 'Parceiro criado!', 'icon' => 'success']]);
    }

    public function showProfile()
    {
        $pharmacy = Pharmacy::query()->where('owner_id', Auth::user()->id)->first()->toArray();
        return view('admin.parceiros.profile', compact('pharmacy'));
    }

    public function update(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required',
            'pet' => 'required',
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $partner = Pharmacy::query()->where('owner_id', Auth::user()->id)->first();
        $partner->name = $request->name;
        $partner->phone = $request->phone;
        $partner->pet = boolval($request->pet);
        $partner->save();

        return redirect()->back()->with(['status' => ['text' => 'Informações alteradas!', 'icon' => 'success']]);
    }

    public function changeAddress(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'address' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'number' => 'required',
            'cep' => 'required',
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $partner = Pharmacy::query()->where('owner_id', Auth::user()->id)->first();
        $partner->zip_code = $request->cep;
        $partner->street = $request->address;
        $partner->neighborhood = $request->neighborhood;
        $partner->city = $request->city;
        $partner->state = $request->state;
        $partner->number = (int)$request->number;
        $partner->save();

        return redirect()->back()->with(['status' => ['text' => 'Informações alteradas!', 'icon' => 'success']]);
    }

    public function changeLogo(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'file' => 'required|image|mimes:png,jpg,jpeg|max:1024'
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $storage = Storage::disk('local');
        $file = $request->file('file');
        $filename = Str::random(32).'.'.Str::lower($file->getClientOriginalExtension());
        $storagePath = 'public/partners/'.$filename;
        $storage->put($storagePath, file_get_contents($file));

        $partner = Pharmacy::query()->where('owner_id', Auth::user()->id)->first();
        Storage::delete('public/partners/'.$partner->logo);
        $partner->logo = $filename;
        $partner->save();


        return redirect()->back()->with(['status' => ['text' => 'Logo atualizada com sucesso!', 'icon' => 'success']]);
    }

    public function remove($id)
    {
        $partner = Pharmacy::find($id);
        // Storage::delete($partner->logo);
        Storage::delete('public/partners/'.$partner->logo);
        $partner->delete();

        return redirect()->route('partners')->with(['status' => ['text' => 'Parceiro removido!', 'icon' => 'success']]);
    }

    public function getPartners(Request $request)
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
        $totalRecords = Pharmacy::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Pharmacy::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Pharmacy::orderBy($columnName,$columnSortOrder)
        ->where('pharmacies.name', 'like', '%' .$searchValue . '%')
        ->orWhere('pharmacies.pet', 'like', '%' .$searchValue . '%')
        ->select('pharmacies.*')
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $data_arr = array();

        foreach($records as $record){
            $id = $record->id;
            $name = Str::ucfirst($record->name);
            $pet = boolval($record->pet);
            $logo = Storage::url('partners/'.$record->logo);
            $since = Carbon::parse($record->created_at)->diffForHumans();

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "pet" => $pet,
                "logo" => ["image" => $logo, "title" => $name],
                "created_at" => $since,
                "actions" => [
                    "remove" => route('partners.remove', $id),
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

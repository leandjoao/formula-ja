<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Faker\Generator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PartnersController extends Controller
{
    public function index()
    {
        $this->adminAccess();
        $partners = Partner::query()->count();

        return view('admin.parceiros.listing', compact('partners'));
    }

    public function showCreate()
    {
        return view('admin.parceiros.create');
    }

    public function create(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|unique:partners,name',
            'pet' => 'required',
            'logo' => 'required|file|max:1048|mimes:png,jpg,jpeg'
        ]);

        if($valid->fails()) return redirect()->back()->with(['errors' => $valid->errors()->messages(), 'icon' => 'error']);

        $storage = Storage::disk('local');
        $file = $request->file('logo');
        $filename = Str::random(32).'.'.Str::lower($file->getClientOriginalExtension());

        $storagePath = 'public/partners/'.$filename;

        $partner = new Partner();
        $partner->name = $request->name;
        $partner->pet = boolval($request->pet);
        $partner->logo = $storagePath;
        $partner->save();

        $storage->put($storagePath, file_get_contents($file));

        return redirect()->back()->with(['status' => ['text' => 'Parceiro criado!', 'icon' => 'success']]);
    }

    public function remove($id)
    {
        $this->adminAccess();

        $partner = Partner::find($id);
        Storage::delete($partner->logo);
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
        $totalRecords = Partner::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Partner::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Partner::orderBy($columnName,$columnSortOrder)
        ->where('partners.name', 'like', '%' .$searchValue . '%')
        ->orWhere('partners.pet', 'like', '%' .$searchValue . '%')
        ->orWhere('partners.logo', 'like', '%' .$searchValue . '%')
        ->select('partners.*')
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $data_arr = array();

        foreach($records as $record){
            $id = $record->id;
            $name = Str::ucfirst($record->name);
            $pet = boolval($record->pet);
            $logo = Storage::url($record->logo);
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

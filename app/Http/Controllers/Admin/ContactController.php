<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $contacts = Contact::query()->count();
        return view('admin.contacts.listing', compact('contacts'));
    }

    public function getContacts(Request $request)
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
        $totalRecords = Contact::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Contact::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();

        // Fetch records
        $records = Contact::orderBy($columnName,$columnSortOrder)
        ->where('contacts.name', 'like', '%' .$searchValue . '%')
        ->orWhere('contacts.email', 'like', '%' .$searchValue . '%')
        ->orWhere('contacts.phone', 'like', '%' .$searchValue . '%')
        ->orWhere('contacts.subject', 'like', '%' .$searchValue . '%')
        ->select('contacts.*')
        ->skip($start)
        ->take($rowperpage)
        ->get();

        $data_arr = array();

        foreach($records as $record){
            $id = $record->id;
            $name = Str::ucfirst($record->name);
            $email = $record->email;
            $phone = $record->phone;
            $subject = $record->subject;
            $since = Carbon::parse($record->created_at)->diffForHumans();

            $data_arr[] = array(
                "id" => $id,
                "name" => $name,
                "email" => $email,
                "phone" => $phone,
                "subject" => $subject,
                "created_at" => $since,
                "actions" => [
                    "view" => route('contact.view', $id),
                    "remove" => route('contact.remove', $id),
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Generator $faker)
    {
        $contacts = [];
        for($i=0; $i<10; $i++) {
            array_push($contacts, [
                'name' => $faker->firstName(),
                'email' => $faker->email(),
                'phone' => $faker->phoneNumber(),
                'created_at' => Carbon::now(),
            ]);
        }

        return view('admin.contacts.listing', compact('contacts'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Faker\Generator;
use Illuminate\Support\Collection;

class PartnersController extends Controller
{
    public function index(Generator $faker)
    {
        $this->adminAccess();

        $parceiros = [];
        for($i=0; $i<10; $i++) {
            array_push($parceiros, [
                'name' => $faker->word(),
                'pet' => boolval(($i % 2))
            ]);
        }

        return view('admin.parceiros.listing', compact('parceiros'));
    }
}

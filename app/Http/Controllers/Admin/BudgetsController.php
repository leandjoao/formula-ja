<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Faker\Generator;
use Illuminate\Http\Request;

class BudgetsController extends Controller
{
    public function index(Generator $faker)
    {
        $status = ['finalizado', 'recusado', 'aguardando', 'enviado'];
        $orcamentos = [];
        for($i=0; $i<10; $i++) {
            array_push($orcamentos, [
                'name' => $faker->word(),
                'pet' => boolval(($i % 2)),
                'created_at' => Carbon::now(),
                'status' => $status[rand(0,3)],
            ]);
        }
        return view('admin.budgets.listing', compact('orcamentos'));
    }

    public function inner()
    {
        return view('admin.budgets.inner');
    }
}

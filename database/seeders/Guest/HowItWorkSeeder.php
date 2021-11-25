<?php

namespace Database\Seeders\Guest;

use App\Models\Guest\HowItWorks;
use Illuminate\Database\Seeder;

class HowItWorkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hiw = new HowItWorks();
        $hiw->icon = "upload.png";
        $hiw->title = "Envio da Receita";
        $hiw->text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet nulla sed elit fermentum, at vulputate ligula.";
        $hiw->save();

        $hiw = new HowItWorks();
        $hiw->icon = "budget.png";
        $hiw->title = "Orçamento";
        $hiw->text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet nulla sed elit fermentum, at vulputate ligula.";
        $hiw->save();

        $hiw = new HowItWorks();
        $hiw->icon = "payment.png";
        $hiw->title = "Pagamento";
        $hiw->text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet nulla sed elit fermentum, at vulputate ligula.";
        $hiw->save();

        $hiw = new HowItWorks();
        $hiw->icon = "manipulate.png";
        $hiw->title = "Manipulação";
        $hiw->text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet nulla sed elit fermentum, at vulputate ligula.";
        $hiw->save();

        $hiw = new HowItWorks();
        $hiw->icon = "deliver.png";
        $hiw->title = "Envio do Produto";
        $hiw->text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet nulla sed elit fermentum, at vulputate ligula.";
        $hiw->save();
    }
}

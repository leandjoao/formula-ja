<?php

namespace Database\Seeders\Guest;

use App\Models\Guest\GetInTouch;
use Illuminate\Database\Seeder;

class GetInTouchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $git = new GetInTouch();
        $git->type = 'fa fa-mobile-alt';
        $git->label = 'Celular:';
        $git->value = '(15) 9 9999-9999';
        $git->save();

        $git = new GetInTouch();
        $git->type = 'fa fa-phone';
        $git->label = 'Telefone:';
        $git->value = '(15) 9999-9999';
        $git->save();

        $git = new GetInTouch();
        $git->type = 'far fa-envelope';
        $git->label = 'E-mail';
        $git->value = 'contato@formulaja.com.br';
        $git->save();
    }
}

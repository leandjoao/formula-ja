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
        $hiw->text = "Através da Fórmulajá, você envia o arquivo de sua prescrição com segurança, às farmácias parceiras.";
        $hiw->save();

        $hiw = new HowItWorks();
        $hiw->icon = "budget.png";
        $hiw->title = "Orçamento";
        $hiw->text = "Analise o orçamento de cada farmácia em seu ambiente de usuário, aqui na plataforma.";
        $hiw->save();

        $hiw = new HowItWorks();
        $hiw->icon = "payment.png";
        $hiw->title = "Pagamento";
        $hiw->text = "Realize o pagamento de seus manipulados de forma simples, rápida e segura.";
        $hiw->save();

        $hiw = new HowItWorks();
        $hiw->icon = "manipulate.png";
        $hiw->title = "Manipulação";
        $hiw->text = "A farmácia escolhida iniciará a produção de seu manipulado.";
        $hiw->save();

        $hiw = new HowItWorks();
        $hiw->icon = "deliver.png";
        $hiw->title = "Envio do Produto";
        $hiw->text = "Acompanhe o envio do seu pedido pelo código de rastreio.";
        $hiw->save();
    }
}

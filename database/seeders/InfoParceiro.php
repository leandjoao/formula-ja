<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InfoParceiro extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('info_parceiro')->insert([
            'title_seo' => 'Formulaja',
            'description_seo' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, earum officia qui optio voluptate nobis.",
            'title_banner' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_banner' => "Lorem ipsum dolor sit amet consectetur",
            'img_banner' => "Lorem ipsum dolor sit amet consectetur",
            'title_numeros' => "Lorem ipsum dolor sit amet consectetur",
            'title_numero1' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_numero1' => "Lorem ipsum dolor sit amet consectetur",
            'title_numero2' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_numero2' => "Lorem ipsum dolor sit amet consectetur",
            'title_numero3' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_numero3' => "Lorem ipsum dolor sit amet consectetur",
            'title_about' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_about' => "Lorem ipsum dolor sit amet consectetur",
            'txt_about' => "Lorem ipsum dolor sit amet consectetur",
            'img_about' => "Lorem ipsum dolor sit amet consectetur",
            'title_diferenciais' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_diferenciais' => "Lorem ipsum dolor sit amet consectetur",
            'title_diferencial1' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_diferencial1' => "Lorem ipsum dolor sit amet consectetur",
            'title_diferencial2' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_diferencial2' => "Lorem ipsum dolor sit amet consectetur",
            'title_diferencial3' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_diferencial3' => "Lorem ipsum dolor sit amet consectetur",
            'title_depoimentos' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_depoimentos' => "Lorem ipsum dolor sit amet consectetur",
            'title_cta' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_cta' => "Lorem ipsum dolor sit amet consectetur",
            'img_cta' => "Lorem ipsum dolor sit amet consectetur",
            'title_form' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_form' => "Lorem ipsum dolor sit amet consectetur",
        ]);
    }
}

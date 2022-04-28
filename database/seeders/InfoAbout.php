<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InfoAbout extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('info_about')->insert([
            'title_seo' => 'Formulaja',
            'description_seo' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, earum officia qui optio voluptate nobis.",
            'title_banner' => "Lorem ipsum dolor sit amet consectetur",
            'img_banner' => "Lorem ipsum dolor sit amet consectetur",
            'txt_about' => "Lorem ipsum dolor sit amet consectetur",
            'img_about' => "Lorem ipsum dolor sit amet consectetur",
            'title_equipe' => "Lorem ipsum dolor sit amet consectetur",
            'txt_equipe' => "Lorem ipsum dolor sit amet consectetur",
            'img_equipe' => "Lorem ipsum dolor sit amet consectetur",
            'title_parceiros' => "Lorem ipsum dolor sit amet consectetur",
        ]);
    }
}

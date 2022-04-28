<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InfoHome extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('info_home')->insert([
            'title_seo' => 'Formulaja',
            'description_seo' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, earum officia qui optio voluptate nobis.",
            'tag_banner' => "Lorem ipsum dolor sit amet consectetur",
            'title_banner' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_banner' => "Lorem ipsum dolor sit amet consectetur",
            'img_banner' => "Lorem ipsum dolor sit amet consectetur",
            'title_como_funciona' => "Lorem ipsum dolor sit amet consectetur",
            'title_cf1' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_cf1' => "Lorem ipsum dolor sit amet consectetur",
            'title_cf2' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_cf2' => "Lorem ipsum dolor sit amet consectetur",
            'title_cf3' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_cf3' => "Lorem ipsum dolor sit amet consectetur",
            'title_cf4' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_cf4' => "Lorem ipsum dolor sit amet consectetur",
            'title_cf5' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_cf5' => "Lorem ipsum dolor sit amet consectetur",
            'title_about' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_about' => "Lorem ipsum dolor sit amet consectetur",
            'txt_about' => "Lorem ipsum dolor sit amet consectetur",
            'img_about' => "Lorem ipsum dolor sit amet consectetur",
            'title_pet' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_pet' => "Lorem ipsum dolor sit amet consectetur",
            'img_pet' => "Lorem ipsum dolor sit amet consectetur",
            'title_blog' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_blog' => "Lorem ipsum dolor sit amet consectetur",
            'title_depoimentos' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_depoimentos' => "Lorem ipsum dolor sit amet consectetur",
            'title_faq' => "Lorem ipsum dolor sit amet consectetur",
            'subtitle_faq' => "Lorem ipsum dolor sit amet consectetur",
            // 'email' => \Str::random(7).'@gmail.com',
        ]);
    }
}

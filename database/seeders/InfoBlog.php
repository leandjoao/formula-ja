<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InfoBlog extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('info_blog')->insert([
            'title_seo' => 'Formulaja',
            'description_seo' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, earum officia qui optio voluptate nobis.",
            'title_banner' => "Lorem ipsum dolor sit amet consectetur",
            'img_banner' => "Lorem ipsum dolor sit amet consectetur",
        ]);
    }
}

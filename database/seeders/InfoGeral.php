<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InfoGeral extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('info_geral')->insert([
            'title' => 'Formulaja',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, earum officia qui optio voluptate nobis.",
            'celular' => '(15)991636394',
            'telefone' => '(15)32626394',
            'email' => \Str::random(7).'@gmail.com',
            'cta' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, earum officia qui optio voluptate nobis.",
            'facebook' => 'facebook.com',
            'instagram' => 'instagram.com',
            'linkedin' => 'linkedin.com',
            'twitter' => 'twitter.com',
            'youtube' => 'youtube.com',
        ]);
    }
}

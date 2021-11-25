<?php

namespace Database\Seeders\Guest;

use App\Models\Guest\SocialMedia;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sm = new SocialMedia();
        $sm->media = "fab fa-facebook-f";
        $sm->link = "";
        $sm->save();

        $sm = new SocialMedia();
        $sm->media = "fab fa-instagram";
        $sm->link = "";
        $sm->save();

        $sm = new SocialMedia();
        $sm->media = "fab fa-youtube";
        $sm->link = "";
        $sm->save();

    }
}

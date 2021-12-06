<?php

namespace Database\Seeders;

use Database\Seeders\Guest\BannerSeeder;
use Database\Seeders\Guest\ExtraTextSeeder;
use Database\Seeders\Guest\FaqSeeder;
use Database\Seeders\Guest\GetInTouchSeeder;
use Database\Seeders\Guest\HowItWorkSeeder;
use Database\Seeders\Guest\SocialMediaSeeder;
use Database\Seeders\Guest\WhyUsSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            Access::class,
            User::class,
            Config::class,
            PostCategorySeeder::class,
            PostSeeder::class,
            PartnersSeeder::class,
            // FakerSeeder::class,

            // Guest
            BannerSeeder::class,
            HowItWorkSeeder::class,
            WhyUsSeeder::class,
            FaqSeeder::class,
            ExtraTextSeeder::class,
            GetInTouchSeeder::class,
            SocialMediaSeeder::class
        ]);
    }
}

<?php

namespace Database\Seeders\Guest;

use App\Models\Guest\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banner = new Banner();
        $banner->super_text = "Lorem Ipsum";
        $banner->slogan = "A sua fórmula, já na mão!";
        $banner->under_text = "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.";
        $banner->isPet = false;
        $banner->save();

        $banner = new Banner();
        $banner->super_text = "Lorem Ipsum";
        $banner->slogan = "Cuide do bem-estar e saúde do seu animalzinho";
        $banner->under_text = "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.";
        $banner->isPet = true;
        $banner->save();
    }
}

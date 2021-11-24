<?php

namespace Database\Seeders;

use App\Models\Partner;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class PartnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 20; $i++) {
            $partner = new Partner();
            $partner->name = $faker->company;
            $partner->pet = boolval(($i % 2));
            $partner->logo = $faker->imageUrl;
            $partner->save();
        }
    }
}

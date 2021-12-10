<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
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
        for ($i=0; $i < 1; $i++) {
            $partner = new Pharmacy();
            $partner->name = $faker->company;
            $partner->street = $faker->streetName;
            $partner->zipCode = "18000-000";
            $partner->neighborhood = $faker->word;
            $partner->city = $faker->city;
            $partner->state = $faker->word;
            $partner->number = random_int(0, 99);
            $partner->cnpj = "00.000.000/0000-00";
            $partner->phone = $faker->phoneNumber;
            $partner->owner_id = 3;
            $partner->pet = boolval(($i % 2));
            $partner->logo = $faker->imageUrl;
            $partner->save();
        }
    }
}

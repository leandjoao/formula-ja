<?php

namespace Database\Seeders\Guest;

use App\Models\Guest\Faq;
use Faker\Generator;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run(Generator $faker)
    {
        for ($i=0; $i < 10; $i++) {
            $faq = new Faq();
            $faq->question = $faker->word;
            $faq->answer = $faker->text;
            $faq->partner = rand(0,1);
            $faq->pet = rand(0,1);
            $faq->save();
        }
    }
}

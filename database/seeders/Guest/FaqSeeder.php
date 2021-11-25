<?php

namespace Database\Seeders\Guest;

use App\Models\Guest\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        for ($i=0; $i < 4; $i++) {
            $faq = new Faq();
            $faq->question = "Lorem Ipsum";
            $faq->answer = "Aliquam ultrices a nunc tincidunt semper. Cras dui sapien, cursus eu ultrices quis, sodales eget lorem. Nunc varius mi a orci ornare sagittis. Nam ac venenatis mauris, condimentum malesuada eros. Aenean rutrum, augue vel consequat fringilla, ligula dui venenatis velit, et eleifend metus odio ultrices dui.";
            $faq->save();
        }
    }
}

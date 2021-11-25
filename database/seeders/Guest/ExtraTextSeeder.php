<?php

namespace Database\Seeders\Guest;

use App\Models\Guest\ExtraTexts;
use Illuminate\Database\Seeder;

class ExtraTextSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $et = new ExtraTexts();
        $et->faq_title = "Dúvidas";
        $et->faq_text = "Aliquam ultrices a nunc tincidunt semper. Cras dui sapien, cursus eu ultrices quis, sodales eget lorem. Nunc varius mi a orci ornare sagittis. Nam ac venenatis mauris, condimentum malesuada eros. Aenean rutrum, augue vel consequat fringilla, ligula dui venenatis velit, et eleifend metus odio ultrices dui.";
        $et->cta = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis, error?";
        $et->about_us_text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium est at risus placerat viverra. Nam ut blandit odio, nec condimentum eros. Phasellus nulla felis, laoreet in ipsum vitae, congue vulputate tortor. Aenean nulla nibh, rhoncus nec sem in, luctus eleifend lorem. Etiam pulvinar, mauris at iaculis suscipit, lectus neque auctor nunc, ac placerat magna lacus quis enim. Integer volutpat mauris eget nunc commodo, ac pharetra urna varius. Aenean et mi non justo aliquet interdum in ac dolor. <br /> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium est at risus placerat viverra. Nam ut blandit odio, nec condimentum eros. Phasellus nulla felis, laoreet in ipsum vitae, congue vulputate tortor. Aenean nulla nibh, rhoncus nec sem in, luctus eleifend lorem. Etiam pulvinar, mauris at iaculis suscipit, lectus neque auctor nunc, ac placerat magna lacus quis enim. Integer volutpat mauris eget nunc commodo, ac pharetra urna varius. Aenean et mi non justo aliquet interdum in ac dolor.";
        $et->about_us_image = "team.jpeg";
        $et->team_text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque pretium est at risus placerat viverra. Nam ut blandit odio, nec condimentum eros. Phasellus nulla felis, laoreet in ipsum vitae, congue vulputate tortor. Aenean nulla nibh, rhoncus nec sem in, luctus eleifend lorem. Etiam pulvinar, mauris at iaculis suscipit, lectus neque auctor nunc, ac placerat magna lacus quis enim. Integer volutpat mauris eget nunc commodo, ac pharetra urna varius. Aenean et mi non justo aliquet interdum in ac dolor.";
        $et->team_image = "team-banner.jpg";
        $et->contact_text = "Entre em contato conosco para tirar qualquer dúvida, será um prazer em lhe atender.";
        $et->save();
    }
}

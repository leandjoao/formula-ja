<?php

namespace Database\Seeders\Guest;

use App\Models\Guest\WhyUs;
use Illuminate\Database\Seeder;

class WhyUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wu = new WhyUs();
        $wu->title = "Por que nós?";
        $wu->under_title = "O melhor para a sua saúde!";
        $wu->text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vulputate nec quam sit amet mollis. Integer urna enim, semper vitae cursus sit amet, hendrerit eget turpis. Duis mauris massa, pharetra a scelerisque in, imperdiet non leo. Nulla feugiat purus at felis efficitur malesuada. Vestibulum vestibulum luctus lacus, nec tempor est tincidunt in. Ut velit nunc, rutrum non sem pellentesque, ultricies ultricies mauris. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.";
        $wu->save();

    }
}

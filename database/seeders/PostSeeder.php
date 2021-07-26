<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) {
            $post = new Post();
            $post->title = $faker->word;
            $post->content = str_repeat($faker->paragraph, $i + 2);
            $post->category_id = 1;
            $post->slug = Str::slug($faker->word);
            $post->banner = "https://picsum.photos/1920/1080";
            $post->user_id = 1;
            $post->save();
        }
    }
}

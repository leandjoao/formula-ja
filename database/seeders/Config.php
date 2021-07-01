<?php

namespace Database\Seeders;

use App\Models\Config as ModelsConfig;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class Config extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configs = new ModelsConfig();
        $configs->logo = Str::slug(config('app.name')).'.png';
        $configs->terms = null;
        $configs->privacy = null;
        $configs->save();
    }
}

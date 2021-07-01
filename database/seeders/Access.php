<?php

namespace Database\Seeders;

use App\Models\AccessLevel;
use Illuminate\Database\Seeder;

class Access extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accesses = ['admin', 'user', 'farmacia'];

        foreach($accesses as $access) {
            $db = new AccessLevel();
            $db->label = $access;
            $db->save();
        }
    }
}

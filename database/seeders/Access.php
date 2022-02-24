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
        $accesses = ['Administrador', 'Usuário', 'Parceiro'];

        foreach($accesses as $access) {
            $db = new AccessLevel();
            $db->label = $access;
            $db->save();
        }
    }
}

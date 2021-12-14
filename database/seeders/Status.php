<?php

namespace Database\Seeders;

use App\Models\Status as ModelsStatus;
use Illuminate\Database\Seeder;

class Status extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = ['novo', 'aguardando cliente', 'aguardando envio', 'enviado', 'entregue', 'recusado'];
        foreach ($status as $value) {
            $save = new ModelsStatus();
            $save->label = $value;
            $save->save();
        }
    }
}

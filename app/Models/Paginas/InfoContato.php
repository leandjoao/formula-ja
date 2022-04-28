<?php

namespace App\Models\Paginas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoContato extends Model
{
    use HasFactory;
    protected $table = 'info_contato';

    protected $guarded = array('id');
    protected $primaryKey = 'id';
}

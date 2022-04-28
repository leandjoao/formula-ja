<?php

namespace App\Models\Paginas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoHome extends Model
{
    use HasFactory;
    protected $table = 'info_home';

    protected $guarded = array('id');
    protected $primaryKey = 'id';
}

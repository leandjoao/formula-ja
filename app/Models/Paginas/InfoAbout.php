<?php

namespace App\Models\Paginas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoAbout extends Model
{
    use HasFactory;
    protected $table = 'info_about';

    protected $guarded = array('id');
    protected $primaryKey = 'id';
}

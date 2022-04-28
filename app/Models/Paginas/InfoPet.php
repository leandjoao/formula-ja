<?php

namespace App\Models\Paginas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoPet extends Model
{
    use HasFactory;
    protected $table = 'info_pet';

    protected $guarded = array('id');
    protected $primaryKey = 'id';
}

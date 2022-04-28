<?php

namespace App\Models\Paginas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoParceiro extends Model
{
    use HasFactory;
    protected $table = 'info_parceiro';

    protected $guarded = array('id');
    protected $primaryKey = 'id';
}

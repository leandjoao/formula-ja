<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoGeral extends Model
{
    use HasFactory;
    protected $table = 'info_geral';

    protected $guarded = array('id');
    protected $primaryKey = 'id';
}

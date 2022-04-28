<?php

namespace App\Models\Paginas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoFaq extends Model
{
    use HasFactory;
    protected $table = 'info_faq';

    protected $guarded = array('id');
    protected $primaryKey = 'id';
}

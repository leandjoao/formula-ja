<?php

namespace App\Models\Paginas;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoBlog extends Model
{
    use HasFactory;
    protected $table = 'info_blog';

    protected $guarded = array('id');
    protected $primaryKey = 'id';
}

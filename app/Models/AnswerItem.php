<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerItem extends Model
{
    use HasFactory;

    protected $hidden = ['id', 'budget_id', 'partner_id', 'answer_id', 'created_at', 'updated_at'];
}

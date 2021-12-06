<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetAnswered extends Model
{
    use HasFactory;

    protected $hidden = ['budget_id', 'user_id', 'created_at', 'updated_at'];

    public function items()
    {
        return $this->hasMany(AnswerItem::class, 'answer_id', 'id');
    }

    public function info()
    {
        return $this->hasOne(Pharmacy::class, 'id', 'answered_by');
    }
}

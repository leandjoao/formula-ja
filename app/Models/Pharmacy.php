<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    public function owner()
    {
        return $this->hasOne(User::class, 'id', 'owner_id');
    }

    public function answers()
    {
        return $this->hasMany(BudgetAnswered::class, 'answered_by', 'id')->with('items');
    }
}

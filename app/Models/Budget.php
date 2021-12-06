<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function file()
    {
        return $this->hasOne(Upload::class, 'id', 'upload_id');
    }

    public function answers()
    {
        return $this->hasMany(BudgetAnswered::class)->with(['info', 'items']);
    }
}

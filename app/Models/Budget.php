<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $hidden = [
        'upload_id', 'sendToAddress'
    ];

    public function sender()
    {
        return $this->hasOne(User::class, 'id', 'user_id')->with('address');
    }

    public function file()
    {
        return $this->hasOne(Upload::class, 'id', 'upload_id');
    }

    public function answers()
    {
        return $this->hasMany(BudgetAnswered::class)->with(['info', 'items']);
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'sendToAddress');
    }

    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
}

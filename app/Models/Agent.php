<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $fillable = ['code', 'name'];

    public function calls()
    {
        return $this->hasMany(Call::class);
    }
}
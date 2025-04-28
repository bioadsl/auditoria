<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $fillable = ['name'];

    public function servers(): HasMany
    {
        return $this->hasMany(Server::class);
    }

    public function calls(): HasMany
    {
        return $this->hasMany(Call::class);
    }
} 
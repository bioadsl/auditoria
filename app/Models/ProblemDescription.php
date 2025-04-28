<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProblemDescription extends Model
{
    protected $fillable = ['description'];

    public function calls(): HasMany
    {
        return $this->hasMany(Call::class);
    }
} 
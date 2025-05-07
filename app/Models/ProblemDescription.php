<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProblemDescription extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'category', 'is_active'];
    protected $table = 'problem_descriptions';

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function calls(): HasMany
    {
        return $this->hasMany(Call::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
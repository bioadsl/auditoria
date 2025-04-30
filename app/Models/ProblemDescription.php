<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProblemDescription extends Model
{
    protected $table = 'problem_descriptions';
    protected $fillable = ['description'];
}
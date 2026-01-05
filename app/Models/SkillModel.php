<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkillModel extends Model
{
    protected $table = 'skills';

    protected $fillable = [
        'id',
        'name',
        'description'
    ];
}

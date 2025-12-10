<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VacanceModel extends Model
{
    protected $table = 'vacancies';

    public $timestamps = true;

    protected $fillable = [
        'title',
        'description',
        'number_of_positions',
        'requirements',
        'salary',
        'application_deadline',
        'active',
        'deleted_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternshipModel extends Model
{
    protected $table = 'internships';

    public $timestamps = false;

    protected $fillable = [
        'workload',
        'schedule',
        'start_date',
        'end_date',
        'salary',
        'observation',
        'supervisor',
        'company_id',
        'internship_status_id',
        'user_id'
    ];
}

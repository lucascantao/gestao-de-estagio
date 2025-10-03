<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estagio extends Model
{
    protected $table = 'estagios';

    protected $fillable = [
        'workload',
        'day_period',
        'start_date',
        'end_date',
        'salary',
        'observation',
        'supervisor',
        'empresas_id',
        'estagios_status_id',
        'users_id'
    ];
}

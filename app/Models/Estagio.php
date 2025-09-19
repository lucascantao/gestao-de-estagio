<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estagio extends Model
{
    protected $table = 'estagios';

    protected $fillable = [
        'carga_horaria',
        'horario',
        'data_inicio',
        'data_termino',
        'salario',
        'observacao',
        'supervisor',
        'empresas_id',
        'estagios_status_id',
        'users_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';

    protected $fillable = [
        'name',
        'cnpj',
        'address',
        'email',
        'phone'
    ];
}

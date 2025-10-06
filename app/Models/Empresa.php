<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table = 'empresas';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'cnpj',
        'address',
        'email',
        'phone'
    ];
}

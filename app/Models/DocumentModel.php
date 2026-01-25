<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentModel extends Model
{
    protected $table = 'documents';

    public $timestamps = true;

    protected $fillable = [
        'path',
        'filename',
        'user_id',
        'internship_id'
    ];
}

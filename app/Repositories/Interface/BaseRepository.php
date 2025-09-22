<?php

namespace App\Repositories\Interface;

use App\Models\Estagio;
use Illuminate\Database\Eloquent\Model;

interface BaseRepository {

    public function store(array $data): Model;

}

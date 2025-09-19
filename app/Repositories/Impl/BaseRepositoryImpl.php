<?php

namespace App\Repositories\Impl;

use App\Repositories\Interface\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class BaseRepositoryImpl implements BaseRepository{

    /**
     * BaseRepositoryImpl constructor.
     *
     * @param Model|null $model
     */
    public function __construct(
        protected ?Model $model
    ) {}
}

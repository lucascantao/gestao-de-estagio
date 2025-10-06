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

    public function store(array  $data): Model {
        return $this->model::create($data);
    }

    public function update(int $id, array  $data): bool {
        if(empty($data)) {
            throw new \InvalidArgumentException("Data array cannot be empty");
        }
        return $this->model::where('id', $id)->update($data);
    }
}

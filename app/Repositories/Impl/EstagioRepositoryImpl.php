<?php

namespace App\Repositories\Impl;

use App\Models\Estagio;
use App\Repositories\Interface\EstagioRepository;
use Illuminate\Pagination\LengthAwarePaginator;

// use App\Models\Estagio;

class EstagioRepositoryImpl extends BaseRepositoryImpl implements EstagioRepository{

    public function __construct(Estagio $model) {
        parent::__construct($model);
    }

    public function getAllEstagios(int $page, int $perPage): LengthAwarePaginator {
        $query = $this->model::select('*');

        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}

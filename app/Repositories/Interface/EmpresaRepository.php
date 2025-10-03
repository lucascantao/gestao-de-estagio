<?php

namespace App\Repositories\Interface;

use App\Repositories\Interface\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

interface EmpresaRepository extends BaseRepository {
    public function getAllEmpresas(int $page, int $perPage): LengthAwarePaginator;

    public function create(array $data);
}

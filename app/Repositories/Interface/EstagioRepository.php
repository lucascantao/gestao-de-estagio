<?php

namespace App\Repositories\Interface;

use App\Repositories\Interface\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

interface EstagioRepository extends BaseRepository {
    public function getAllEstagios(int $page, int $perPage): LengthAwarePaginator;

    public function getEstagioById(int $id);
}

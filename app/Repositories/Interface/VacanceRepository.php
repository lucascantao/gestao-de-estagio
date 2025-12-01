<?php

namespace App\Repositories\Interface;

use App\Repositories\Interface\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

interface VacanceRepository extends BaseRepository {
    public function getAllVacancies(int $page, int $perPage): LengthAwarePaginator;

    public function getVacanceById(int $id);
}

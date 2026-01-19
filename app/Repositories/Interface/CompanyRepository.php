<?php

namespace App\Repositories\Interface;

use App\Repositories\Interface\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

interface CompanyRepository extends BaseRepository {
    public function getAllCompanies(int $page, int $perPage): LengthAwarePaginator;

    public function getCompanies();
}

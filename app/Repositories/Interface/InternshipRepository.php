<?php

namespace App\Repositories\Interface;

use App\Http\DTO\Request\InternshipRequestFilterDTO;
use App\Repositories\Interface\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

interface InternshipRepository extends BaseRepository {
    public function getAllInternships(int $page, int $perPage, InternshipRequestFilterDTO $filter): LengthAwarePaginator;

    public function getInternshipById(int $id);
    
    public function getInternshipByUserId(int $userId);

    public function getUserIdByInternshipId(int $internshipId): ?int;
}

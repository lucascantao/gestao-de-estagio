<?php

namespace App\Repositories\Interface;

use App\Repositories\Interface\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

interface InternshipRepository extends BaseRepository {
    public function getAllInternships(int $page, int $perPage): LengthAwarePaginator;

    public function getInternshipById(int $id);

    public function getUserIdByInternshipId(int $internshipId): ?int;

    public function insertDocument(array $data): void;
}

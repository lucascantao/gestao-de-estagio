<?php

namespace App\Repositories\Interface;

use App\Repositories\Interface\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

interface DocumentRepository extends BaseRepository {
    public function getDocumentByInternshipId(int $internshipId);

    public function insertDocument(array $data, int $internshipId);
}

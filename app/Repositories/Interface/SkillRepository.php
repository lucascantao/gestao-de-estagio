<?php

namespace App\Repositories\Interface;

use App\Repositories\Interface\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

interface SkillRepository extends BaseRepository {
    public function getAllSkills(int $page, int $perPage): LengthAwarePaginator;

    public function getSkills();

    public function getSkillByUserId(int $userId);

    public function assignSkillsToUser(array $skillIds, int $userId): void;
}

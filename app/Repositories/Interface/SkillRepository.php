<?php

namespace App\Repositories\Interface;

use App\Repositories\Interface\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

interface SkillRepository extends BaseRepository {
    public function getAllSkills(int $page, int $perPage): LengthAwarePaginator;

    public function getSkills();

    // public function getSkillById(int $id);
}

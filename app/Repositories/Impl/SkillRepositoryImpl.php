<?php

namespace App\Repositories\Impl;

use App\Models\SkillModel;
use App\Repositories\Interface\SkillRepository;
use Illuminate\Pagination\LengthAwarePaginator;

// use App\Models\Estagio;

class SkillRepositoryImpl extends BaseRepositoryImpl implements SkillRepository{

    public function __construct(SkillModel $model) {
        parent::__construct($model);
    }

    // public function getSkillById(int $id): ?SkillModel {
    //     $query = $this->model::select(
    //         'skills.*'
    //     )
    //     ->where('skills.id', '=', $id);
    //     return $query->first();
    // }

    public function getAllSkills(int $page, int $perPage): LengthAwarePaginator {
        $query = $this->model::select('*')
        ->orderBy('skills.name');

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    public function getSkills() {
        $query = $this->model::select('*')
        ->orderBy('skills.name');

        return $query->get();
    }
}

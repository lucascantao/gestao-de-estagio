<?php

namespace App\Repositories\Impl;

use App\Models\SkillModel;
use App\Repositories\Interface\SkillRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

// use App\Models\Estagio;

class SkillRepositoryImpl extends BaseRepositoryImpl implements SkillRepository{

    public function __construct(SkillModel $model) {
        parent::__construct($model);
    }

    public function getSkillByUserId(int $userId) {
        $query = $this->model::select(
            'skills.*'
        )
        ->join('user_skills', 'skills.id', '=', 'user_skills.skill_id')
        ->where('user_skills.user_id', '=', $userId);
        return $query->get();
    }

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

    public function assignSkillsToUser(array $skillIds, int $userId): void {
        $currentSkills = DB::table('user_skills')->where('user_id', $userId)->pluck('skill_id')->toArray();
        $removedSkills = array_filter($currentSkills, function($skill) use ($skillIds) {
            return !in_array($skill, $skillIds);
        });
        $newSkills = array_filter($skillIds, function($skillId) use ($currentSkills) {
            return !in_array($skillId, $currentSkills);
        });

        DB::table('user_skills')->whereIn('skill_id', $removedSkills)->delete();

        $data = [];
        foreach($newSkills as $skillId) {
            $data[] = [
                'user_id' => $userId,
                'skill_id' => $skillId
            ];
        }

        DB::table('user_skills')->insert($data);
    }
}

<?php

namespace App\utils\traits;

use App\Http\DTO\Request\User\StudentFilterDTO;

trait StudentFilter {
    
    public function filter($query, StudentFilterDTO $filter) {
        $this->filterBySearchString($query, $filter->getSearch());
        $this->filterBySkills($query, $filter->getSkills());
        return $query;
    }

    private function filterBySearchString( &$query, ?string $search) {
        if(!$search) return;

        $query->where('user.name', 'like', '%' . $search . '%')
            ->orWhere('user.email', 'like', '%' . $search . '%')
            ->orWhere('user_enrollments.student_number', 'like', '%' . $search . '%');
    }

    private function filterBySkills( &$query, ?array $skills) {
        if(!$skills) return;

        $query->join('user_skills', 'users.id', '=', 'user_skills.user_id')
            ->whereIn('user_skills.skill_id', $skills);
    }

}

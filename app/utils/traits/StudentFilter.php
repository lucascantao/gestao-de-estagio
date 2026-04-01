<?php

namespace App\utils\traits;

use App\Http\DTO\Request\User\StudentFilterDTO;

trait StudentFilter {
    
    public function filter($query, StudentFilterDTO $filter) {
        $this->filterBySearchString($query, $filter->getSearch());
        $this->filterBySkills($query, $filter->getSkills());
        $this->filterByCourses($query, $filter->getCourses());
        return $query;
    }

    private function filterBySearchString( &$query, ?string $search) {
        if(!$search) return;

        // dd($query->toSql(), $query->getBindings());

        $query
            ->where('users.name', 'like', '%' . $search . '%')
            ->orWhere('users.email', 'like', '%' . $search . '%')
            ->orWhere('user_enrollments.student_number', 'like', '%' . $search . '%');
    }

    private function filterBySkills( &$query, ?array $skills) {
        if(!$skills) return;

        $query->join('user_skills', 'users.id', '=', 'user_skills.user_id')
            ->whereIn('user_skills.skill_id', $skills);
    }

    private function filterByCourses( &$query, ?array $courses) {
        if(!$courses) return;

        $query->whereIn('user_enrollments.course_id', $courses);
    }

}

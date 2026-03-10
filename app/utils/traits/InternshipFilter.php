<?php

namespace App\utils\traits;

use App\Http\DTO\Request\InternshipRequestFilterDTO;

trait InternshipFilter {
    
    public function filter($query, InternshipRequestFilterDTO $filter) {
        $this->filterBySearchString($query, $filter->getSearch());
        return $query;
    }

    private function filterBySearchString( &$query, ?string $search) {
        if(!$search) return;

        $query->where('user.name', 'like', '%' . $search . '%')
            ->orWhere('user.email', 'like', '%' . $search . '%')
            ->orWhere('user_enrollments.student_number', 'like', '%' . $search . '%');
    }

}

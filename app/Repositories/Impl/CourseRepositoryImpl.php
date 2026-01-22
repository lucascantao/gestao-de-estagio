<?php

namespace App\Repositories\Impl;

use App\Models\CourseModel;
use App\Repositories\Interface\CourseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class CourseRepositoryImpl extends BaseRepositoryImpl implements CourseRepository {

    public function __construct(CourseModel $model) {
        parent::__construct($model);
    }

    public function getAllCourses(int $page, int $perPage): LengthAwarePaginator {
        $query = $this->model::select(
        )        
        ->orderBy('name', 'desc');

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    public function getCourses() {
        $query = $this->model::select('*')
        ->orderBy('courses.name');

        return $query->get();
    }
}

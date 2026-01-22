<?php

namespace App\Repositories\Interface;

use App\Repositories\Interface\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

interface CourseRepository extends BaseRepository {
    public function getAllCourses(int $page, int $perPage): LengthAwarePaginator;

    public function getCourses();
}

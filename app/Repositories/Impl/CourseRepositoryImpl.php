<?php

namespace App\Repositories\Impl;

use App\Models\CourseModel;
use App\Repositories\Interface\CourseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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

    public function assignCourseToUser(array $course, int $userId) {
        $userCourse = DB::table('user_enrollments')->where('user_id', $userId);
        // dd($userCourse->first());
        if($userCourse->first()) {
            DB::table('user_enrollments')->where('user_id', $userId)->update($course);
        } else {
            DB::table('user_enrollments')->insert($course);
        }
        // DB::table('user_enrollments')->where('user_id', $userId)->updateOrInsert($course);

        // DB::table('user_skills')->insert($data);
    }
}

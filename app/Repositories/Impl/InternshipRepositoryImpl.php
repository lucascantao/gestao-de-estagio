<?php

namespace App\Repositories\Impl;

use App\Models\InternshipModel;
use App\Repositories\Interface\InternshipRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

// use App\Models\Estagio;

class InternshipRepositoryImpl extends BaseRepositoryImpl implements InternshipRepository{

    public function __construct(InternshipModel $model) {
        parent::__construct($model);
    }

    public function getInternshipById(int $id): ?InternshipModel {
        $query = $this->model::select(
            'internships.id',
            'internships.workload',
            'internships.schedule',
            'internships.start_date',
            'internships.end_date',
            'internships.salary',
            'internships.observation',
            'internships.supervisor',
            'internships.company_id',
            'internship_status.id as internship_status_id',
            'internship_status.name as internship_status_name',
            'users.id as user_id',
            'users.name as user_name',
            'users.email as user_email',
            'roles.id as role_id',
            'roles.name as role_name',
            'courses.id as course_id',
            'courses.name as course_name',
        )
        ->join('internship_status', 'internships.internship_status_id', '=', 'internship_status.id')
        ->join('users', 'internships.user_id', '=', 'users.id')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->join('courses', 'users.course_id', '=', 'courses.id')
        ->where('internships.id', '=', $id);

        return $query->first();
    }

    public function getAllInternships(int $page, int $perPage): LengthAwarePaginator {
        $query = $this->model::select(
            'internships.id',
            'internships.workload',
            'internships.schedule',
            'internships.start_date',
            'internships.end_date',
            'internships.salary',
            'internships.observation',
            'internships.supervisor',
            'internships.company_id',
            'internship_status.id as internship_status_id',
            'internship_status.name as internship_status_name',
            'users.id as user_id',
            'users.name as user_name',
            'users.email as user_email',
            'roles.id as role_id',
            'roles.name as role_name',
            'courses.id as course_id',
            'courses.name as course_name',
        )
        ->join('internship_status', 'internships.internship_status_id', '=', 'internship_status.id')
        ->join('users', 'internships.user_id', '=', 'users.id')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->join('courses', 'users.course_id', '=', 'courses.id')
        ->orderBy('internships.id', 'desc');

        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}

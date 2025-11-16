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
            'internship_status.id as internship_status_id',
            'internship_status.name as internship_status_name',
            'companies.id as company_id',
            'companies.name as company_name',
            'users.id as student_id',
            'user_enrollments.student_number',
            'users.name as student_name',
            'users.email as student_email',
            'roles.id as role_id',
            'roles.name as role_name',
            'courses.id as course_id',
            'courses.name as course_name',
        )
        ->join('internship_status', 'internships.internship_status_id', '=', 'internship_status.id')
        ->join('users', 'internships.user_id', '=', 'users.id')
        ->join('user_enrollments', 'users.id', '=', 'user_enrollments.user_id')
        ->join('companies', 'internships.company_id', '=', 'companies.id')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->join('courses', 'user_enrollments.course_id', '=', 'courses.id')
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
            'internship_status.id as internship_status_id',
            'internship_status.name as internship_status_name',
            'companies.id as company_id',
            'companies.name as company_name',
            'users.id as student_id',
            'user_enrollments.student_number',
            'users.name as student_name',
            'users.email as student_email',
            'roles.id as role_id',
            'roles.name as role_name',
            'courses.id as course_id',
            'courses.name as course_name',
        )
        ->join('internship_status', 'internships.internship_status_id', '=', 'internship_status.id')
        ->join('users', 'internships.user_id', '=', 'users.id')
        ->join('user_enrollments', 'users.id', '=', 'user_enrollments.user_id')
        ->join('companies', 'internships.company_id', '=', 'companies.id')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->join('courses', 'user_enrollments.course_id', '=', 'courses.id')
        ->orderBy('internships.id', 'desc');

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    public function getUserIdByInternshipId(int $internshipId): ?int {
        $internship = $this->model::select('user_id')
            ->where('id', '=', $internshipId)
            ->first();

        return $internship ? $internship->user_id : null;
    }

    public function insertDocument(array $data): void {
        DB::table('documents')->insert($data);
    }
}

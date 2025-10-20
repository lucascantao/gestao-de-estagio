<?php

namespace App\Repositories\Impl;

use App\Models\CompanyModel;
use App\Repositories\Interface\CompanyRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class CompanyRepositoryImpl extends BaseRepositoryImpl implements CompanyRepository {

    public function __construct(CompanyModel $model) {
        parent::__construct($model);
    }

    public function getAllCompanies(int $page, int $perPage): LengthAwarePaginator {
        $query = $this->model::select(
        )
        ->join('users', 'internships.users_id', '=', 'users.id')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->join('courses', 'users.course_id', '=', 'courses.id')
        ->orderBy('internships.id', 'desc');

        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}

<?php

namespace App\Repositories\Impl;

use App\Http\Exceptions\DatabaseException;
use App\Http\Exceptions\NotFoundException;
use App\Models\UserModel;
use App\Repositories\Interface\UserRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

// use App\Models\Estagio;

class UserRepositoryImpl extends BaseRepositoryImpl implements UserRepository{

    public function __construct(UserModel $model) {
        parent::__construct($model);
    }

    public function findUserById(int $id): ?UserModel {
        try {
            $query = $this->model::query()->select([
                'users.*',
                'roles.name as role_name',
                'roles.id as role_id',
            ])
                ->leftJoin( 'roles', 'users.role_id', '=', 'roles.id')
                ->where($this->model->getTable() . ".id", "=", $id);
            return $query->firstOrFail();
        }
        catch (ModelNotFoundException $e) {
            throw new NotFoundException("Id inválido: " . $id);
        }
        catch (Exception $e) {
            throw new DatabaseException("Erro ao buscar usuário: " . $e->getMessage());
        }
    }


    public function findByEmail(string $email): ?UserModel {
        $query = UserModel::join('roles', 'users.role_id', '=', 'roles.id')
                    ->select(
                        'users.id',
                        'users.name',
                        'users.email',
                        'users.password',
                        'users.created_at',
                        'users.updated_at',
                        'roles.name as role_name',
                        'roles.id as role_id',
                    )
                    ->where('email', $email);
        return $query->first();
    }

    public function getUserDataById(int $userId): ?UserModel {
        $query = $this->model::query()->select([
            'users.id',
            'users.name',
            'users.email',
            'roles.id as role_id',
            'roles.name as role_name',
            'internships.workload',
            'internships.schedule',
            'internships.salary',
            'internship_status.name as internship_status_name',
            'companies.id as company_id',
            'companies.name as company_name',
            'user_enrollments.student_number',
            'courses.id as course_id',
            'courses.name as course_name'
        ])
        ->where('users.id', '=', $userId)
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->join('internships', 'users.id', '=', 'internships.user_id')
        ->join('internship_status', 'internships.internship_status_id', '=', 'internship_status.id')
        ->join('companies', 'internships.company_id', '=', 'companies.id')
        ->join('user_enrollments', 'users.id', '=', 'user_enrollments.user_id')
        ->join('courses', 'user_enrollments.course_id', '=', 'courses.id');

        return $query->first();
    }


}

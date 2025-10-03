<?php

namespace App\Repositories\Impl;

use App\Models\Estagio;
use App\Repositories\Interface\EstagioRepository;
use Illuminate\Pagination\LengthAwarePaginator;

// use App\Models\Estagio;

class EstagioRepositoryImpl extends BaseRepositoryImpl implements EstagioRepository{

    public function __construct(Estagio $model) {
        parent::__construct($model);
    }

    public function getAllEstagios(int $page, int $perPage): LengthAwarePaginator {
        $query = $this->model::select(
            'estagios.id',
            'estagios.workload',
            'estagios.day_period',
            'estagios.start_date',
            'estagios.end_date',
            'estagios.salary',
            'estagios.observation',
            'estagios.supervisor',
            'estagios.empresas_id',
            'estagios_status.id as estagio_status_id',
            'estagios_status.name as estagio_status_name',
            'users.id as user_id',
            'users.name as user_name',
            'users.email as user_email',
            'perfis.id as perfil_id',
            'perfis.name as perfil_name',
            'cursos.id as curso_id',
            'cursos.name as curso_name',
        )
        ->join('estagios_status', 'estagios.estagios_status_id', '=', 'estagios_status.id')
        ->join('users', 'estagios.users_id', '=', 'users.id')
        ->join('perfis', 'users.perfis_id', '=', 'perfis.id')
        ->join('cursos', 'users.cursos_id', '=', 'cursos.id')
        ->orderBy('estagios.id', 'desc');

        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}

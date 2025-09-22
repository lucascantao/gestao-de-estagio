<?php

namespace App\Repositories\Impl;

use App\Models\Empresa;
use App\Repositories\Interface\EmpresaRepository;
use App\Repositories\Interface\EstagioRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class EmpresaRepositoryImpl extends BaseRepositoryImpl implements EmpresaRepository {

    public function __construct(Empresa $model) {
        parent::__construct($model);
    }

    public function getAllEmpresas(int $page, int $perPage): LengthAwarePaginator {
        $query = $this->model::select(
            // 'estagios.id',
            // 'estagios.carga_horaria',
            // 'estagios.horario',
            // 'estagios.data_inicio',
            // 'estagios.data_termino',
            // 'estagios.salario',
            // 'estagios.observacao',
            // 'estagios.supervisor',
            // 'estagios.empresas_id',
            // 'estagios.estagios_status_id',
            // 'users.id as user_id',
            // 'users.name as user_name',
            // 'users.email as user_email',
            // 'perfis.id as perfil_id',
            // 'perfis.nome as perfil_nome',
            // 'cursos.id as curso_id',
            // 'cursos.nome as curso_nome',
        )
        ->join('users', 'estagios.users_id', '=', 'users.id')
        ->join('perfis', 'users.perfis_id', '=', 'perfis.id')
        ->join('cursos', 'users.cursos_id', '=', 'cursos.id')
        ->orderBy('estagios.id', 'desc');

        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}

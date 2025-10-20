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

// use App\Models\Estagio;

class UserRepositoryImpl extends BaseRepositoryImpl implements UserRepository{

    public function __construct(UserModel $model) {
        parent::__construct($model);
    }

    public function findUserById(int $id): ?UserModel {
        try {
            $query = $this->model::query()->select([
                'users.*',
                DB::raw("CASE WHEN users.deleted_at IS NULL THEN 'Ativo' ELSE 'Inativo' END as status"),
                'roles.name as roles_name',
                'roles.id as role_id',
            ])
                ->join( 'roles', 'users.roles_id', '=', 'roles.id')
                ->leftJoin('partners', 'users.partners_id', '=', 'partners.id')
                ->where($this->model->getTable() . ".id", "=", $id);
            return $query
            ->firstOrFail();
        }
        catch (ModelNotFoundException $e) {
            throw new NotFoundException("Id inválido: " . $id);
        }
        catch (Exception $e) {
            throw new DatabaseException("Erro ao buscar usuário: " . $e->getMessage());
        }
    }


}

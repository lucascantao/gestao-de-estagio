<?php

namespace App\Repositories\Impl;

use App\Models\VacanceModel;
use App\Repositories\Interface\VacanceRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

// use App\Models\Estagio;

class VacanceRepositoryImpl extends BaseRepositoryImpl implements VacanceRepository{

    public function __construct(VacanceModel $model) {
        parent::__construct($model);
    }

    public function getVacanceById(int $id): ?VacanceModel {
        $query = $this->model::select(
            'vacancies.*'
        )
        ->where('vacancies.id', '=', $id);

        return $query->first();
    }

    public function getAllVacancies(int $page, int $perPage): LengthAwarePaginator {
        $query = $this->model::select(
            'vacancies.*',
        )
        ->where( function($q) {
            $q->whereNull('vacancies.deleted_at');
            $q->where('vacancies.active', true);
            $q->where('vacancies.application_deadline', '>=', date('Y-m-d'));
        })
        ->orderBy('vacancies.id', 'desc');

        return $query->paginate($perPage, ['*'], 'page', $page);
    }
}

<?php

namespace App\Services;

use App\Http\DTO\Response\EstagioDTO;
use App\Http\DTO\Response\PageResponseDTO;
use App\Repositories\Interface\EstagioRepository;
use Illuminate\Support\Facades\DB;

class EstagioService {

    public function __construct(
        protected EstagioRepository $estagioRepository
    ) {}

    public function getAllEstagios(int $page, int $perpage): PageResponseDTO {
        $paginator = $this->estagioRepository->getAllEstagios($page, $perpage);

        $estagios = $paginator
            ->values()
            ->map(fn($estagio) => EstagioDTO::fromEstagio($estagio))
            ->toArray();

        return PageResponseDTO::fromPaginator($paginator, $estagios);

    }

    public function storeEstagio(array $data) {
        $transaction = DB::transaction(function () use ($data) {
            $empresaCreated = true;
            if($data['empresa'] !== null) {
                // dd($data);
                // Cadastrar empresa
                // Pegar o ID da empresa cadastrada
            }

            $estagioCreated = $this->estagioRepository->store($data);
        });

        return [];

    }
}

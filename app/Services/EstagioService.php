<?php

namespace App\Services;

use App\Http\DTO\Request\StoreEstagioRequestDTO;
use App\Http\DTO\Response\EstagioDTO;
use App\Http\DTO\Response\PageResponseDTO;
use App\Repositories\Interface\EmpresaRepository;
use App\Repositories\Interface\EstagioRepository;
use Illuminate\Support\Facades\DB;

class EstagioService {

    public function __construct(
        protected EstagioRepository $estagioRepository,
        protected EmpresaRepository $empresaRepository
    ) {
    }

    public function getAllEstagios(int $page, int $perpage): PageResponseDTO {
        $paginator = $this->estagioRepository->getAllEstagios($page, $perpage);

        $estagios = $paginator
            ->values()
            ->map(fn($estagio) => EstagioDTO::fromEstagio($estagio))
            ->toArray();

        return PageResponseDTO::fromPaginator($paginator, $estagios);

    }

    public function storeEstagio(StoreEstagioRequestDTO $estagio) {
        // dd($estagio);
        $transaction = DB::transaction(function () use ($estagio) {
            $empresaCreated = true;
            if($estagio->getEmpresa() !== null) {
                // dd($estagio->getEmpresa());
                // Cadastrar empresa
                $newEmpresa = $this->empresaRepository->create($estagio->getEmpresa()->toArray());
                dd($newEmpresa);
                // Pegar o ID da empresa cadastrada
            }

            $insertData = $estagio->toArray();

            $estagioCreated = $this->estagioRepository->store($insertData);
        });

        return [];

    }
}

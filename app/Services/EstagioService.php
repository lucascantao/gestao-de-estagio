<?php

namespace App\Services;

use App\Http\DTO\Request\StoreEstagioRequestDTO;
use App\Http\DTO\Response\EstagioDTO;
use App\Http\DTO\Response\PageResponseDTO;
use App\Repositories\Interface\EmpresaRepository;
use App\Repositories\Interface\EstagioRepository;
use App\utils\traits\Exception;
use Illuminate\Support\Facades\DB;

class EstagioService {

    use Exception;

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

    public function storeEstagio(StoreEstagioRequestDTO $estagio): array {
        $response = [];
        try {
            DB::transaction(function () use ($estagio, &$response) {
                $insertData = $estagio->toInsertArray();
                if($estagio->getEmpresa() !== null) {
                    $newEmpresa = $this->empresaRepository->store($estagio->getEmpresa()->toArray());
                    $insertData['empresas_id'] = $newEmpresa->id;
                }
                $this->estagioRepository->store($insertData);
                $response['data'] = ['message' => 'Estágio cadastrado com sucesso.'];
                $response['status'] = 'success';
            });
        } catch (\Exception $e) {
            $response['status'] = 'error';
            $response['exception'] = $this->exception($e, __FILE__, __METHOD__);
        }

        return $response;
    }
}

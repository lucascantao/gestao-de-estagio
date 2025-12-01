<?php

namespace App\Services;

use App\Http\DTO\Request\StoreVacanceRequestDTO;
use App\Http\DTO\Request\UpdateVacanceRequestDTO;
use App\Http\DTO\Response\PageResponseDTO;
use App\Http\DTO\Response\VacanceDTO;
use App\Repositories\Interface\CompanyRepository;
use App\Repositories\Interface\VacanceRepository;
use App\utils\traits\ExceptionTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class VacanceService {

    use ExceptionTrait;

    public function __construct(
        protected VacanceRepository $vacanceRepository,
        protected CompanyRepository $companyRepository,
        protected FileStorageService $fileStorageService
    ) {
    }

    public function getVacanceById(int $id): ?array {
        $response = [];
        $vacance = $this->vacanceRepository->getVacanceById($id);
        $response['status'] = $vacance ? 'success' : 'not_found';
        $response['data'] = $vacance ? VacanceDTO::fromIntership($vacance)->toArray() : ['message' => 'Vaga não encontrada.'];
        return $response;
    }

    public function getAllVacancies(int $page, int $perpage): PageResponseDTO {
        $paginator = $this->vacanceRepository->getAllVacancies($page, $perpage);
        $vacances = $paginator
            ->values()
            ->map(fn($vacance) => VacanceDTO::fromIntership($vacance))
            ->toArray();

        return PageResponseDTO::fromPaginator($paginator, $vacances);
    }

    public function storeVacance(StoreVacanceRequestDTO $vacance): array {
        $response = [];
        try {
            DB::transaction(function () use ($vacance, &$response) {
                $insertData = $vacance->toInsertArray();
                // if($vacance->getCompany() !== null) {
                //     $newCompany = $this->companyRepository->store($vacance->getCompany()->toArray());
                //     $insertData['company_id'] = $newCompany->id;
                // }
                $this->vacanceRepository->store($insertData);
                $response['data'] = ['message' => 'Vaga cadastrada com sucesso.'];
                $response['status'] = 'success';
            });
        } catch (\Exception $e) {
            $response['status'] = 'error';
            $response['exception'] = $this->exception($e, __FILE__, __METHOD__);
        }

        return $response;
    }

    public function updateVacance(int $id, UpdateVacanceRequestDTO $vacance): array {
        $response = [];
        try {
            $updateData = $vacance->toUpdateArray();
            $this->vacanceRepository->update($id, $updateData);
            $response['data'] = ['message' => 'Vaga atualizada com sucesso.'];
            $response['status'] = 'success';
        } catch (\Exception $e) {
            $response['status'] = 'error';
            $response['exception'] = $this->exception($e, __FILE__, __METHOD__);
        }

        return $response;
    }
}

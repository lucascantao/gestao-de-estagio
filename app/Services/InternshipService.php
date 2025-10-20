<?php

namespace App\Services;

use App\Http\DTO\Request\StoreInternshipRequestDTO;
use App\Http\DTO\Request\UpdateInternshipRequestDTO;
use App\Http\DTO\Response\InternshipDTO;
use App\Http\DTO\Response\PageResponseDTO;
use App\Repositories\Interface\CompanyRepository;
use App\Repositories\Interface\InternshipRepository;
use App\utils\traits\Exception;
use Illuminate\Support\Facades\DB;

class InternshipService {

    use Exception;

    public function __construct(
        protected InternshipRepository $intershipRepository,
        protected CompanyRepository $companyRepository
    ) {
    }

    public function getInternshipById(int $id): ?array {
        $response = [];
        $internship = $this->intershipRepository->getInternshipById($id);
        $response['status'] = $internship ? 'success' : 'not_found';
        $response['data'] = $internship ? InternshipDTO::fromIntership($internship)->toArray() : ['message' => 'Estágio não encontrado.'];
        return $response;
    }

    public function getAllInternships(int $page, int $perpage): PageResponseDTO {
        $paginator = $this->intershipRepository->getAllInternships($page, $perpage);
        $internship = $paginator
            ->values()
            ->map(fn($internship) => InternshipDTO::fromIntership($internship))
            ->toArray();

        return PageResponseDTO::fromPaginator($paginator, $internship);
    }

    public function storeInternship(StoreInternshipRequestDTO $internship): array {
        $response = [];
        try {
            DB::transaction(function () use ($internship, &$response) {
                $insertData = $internship->toInsertArray();
                $insertData['internship_status_id'] = 1;
                if($internship->getCompany() !== null) {
                    $newCompany = $this->companyRepository->store($internship->getCompany()->toArray());
                    $insertData['company_id'] = $newCompany->id;
                }
                $this->intershipRepository->store($insertData);
                $response['data'] = ['message' => 'Estágio cadastrado com sucesso.'];
                $response['status'] = 'success';
            });
        } catch (\Exception $e) {
            $response['status'] = 'error';
            $response['exception'] = $this->exception($e, __FILE__, __METHOD__);
        }

        return $response;
    }

    public function updateInternship(int $id, UpdateInternshipRequestDTO $internship): array {
        $response = [];
        try {
            $updateData = $internship->toUpdateArray();
            $this->intershipRepository->update($id, $updateData);
            $response['data'] = ['message' => 'Estágio atualizado com sucesso.'];
            $response['status'] = 'success';
        } catch (\Exception $e) {
            $response['status'] = 'error';
            $response['exception'] = $this->exception($e, __FILE__, __METHOD__);
        }

        return $response;
    }

    public function updateInternshipStatus(int $internshipId, int $statusId): array {
        $response = [];
        try {
            $this->intershipRepository->update($internshipId, ['internship_status_id' => $statusId]);
            $response['data'] = ['message' => 'Status do Estágio atualizado com sucesso.'];
            $response['status'] = 'success';
        } catch (\Exception $e) {
            $response['status'] = 'error';
            $response['exception'] = $this->exception($e, __FILE__, __METHOD__);
        }

        return $response;
    }
}

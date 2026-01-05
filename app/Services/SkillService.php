<?php

namespace App\Services;

use App\Http\DTO\Response\PageResponseDTO;
use App\Http\DTO\Response\SkillDTO;
use App\Http\DTO\Response\VacanceDTO;
use App\Repositories\Interface\CompanyRepository;
use App\Repositories\Interface\SkillRepository;
use App\utils\traits\ExceptionTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class SkillService {

    use ExceptionTrait;

    public function __construct(
        protected SkillRepository $skillRepository
    ) {
    }

    // public function getVacanceById(int $id): ?array {
    //     $response = [];
    //     $vacance = $this->vacanceRepository->getVacanceById($id);
    //     $response['status'] = $vacance ? 'success' : 'not_found';
    //     $response['data'] = $vacance ? VacanceDTO::fromIntership($vacance)->toArray() : ['message' => 'Vaga não encontrada.'];
    //     return $response;
    // }

    public function getAllSkills(?int $page = null, ?int $perpage = null): PageResponseDTO | array {
        if($page === null || $perpage === null) {
            return $this->skillRepository->getSkills()
                ->map(fn($skill) => SkillDTO::fromSkill($skill))
                ->toArray();
        }

        $paginator = $this->skillRepository->getAllSkills($page, $perpage);
        $skills = $paginator
            ->values()
            ->map(fn($skill) => SkillDTO::fromSkill($skill))
            ->toArray();

        return PageResponseDTO::fromPaginator($paginator, $skills);
    }

    // public function storeVacance(StoreVacanceRequestDTO $vacance): array {
    //     $response = [];
    //     try {
    //         DB::transaction(function () use ($vacance, &$response) {
    //             $insertData = $vacance->toInsertArray();
    //             // if($vacance->getCompany() !== null) {
    //             //     $newCompany = $this->companyRepository->store($vacance->getCompany()->toArray());
    //             //     $insertData['company_id'] = $newCompany->id;
    //             // }
    //             $this->vacanceRepository->store($insertData);
    //             $response['data'] = ['message' => 'Vaga cadastrada com sucesso.'];
    //             $response['status'] = 'success';
    //         });
    //     } catch (\Exception $e) {
    //         $response['status'] = 'error';
    //         $response['exception'] = $this->exception($e, __FILE__, __METHOD__);
    //     }

    //     return $response;
    // }

    // public function updateVacance(int $id, UpdateVacanceRequestDTO $vacance): array {
    //     $response = [];
    //     try {
    //         $updateData = $vacance->toUpdateArray();
    //         $this->vacanceRepository->update($id, $updateData);
    //         $response['data'] = ['message' => 'Vaga atualizada com sucesso.'];
    //         $response['status'] = 'success';
    //     } catch (\Exception $e) {
    //         $response['status'] = 'error';
    //         $response['exception'] = $this->exception($e, __FILE__, __METHOD__);
    //     }

    //     return $response;
    // }

    // public function deleteVacance(int $id): array {
    //     $response = [];
    //     try {
    //         $vacance = $this->vacanceRepository->getVacanceById($id);
    //         if(!$vacance || $vacance->deleted_at !== null) {
    //             $response['status'] = 'not_found';
    //             $response['data'] = ['message' => 'Vaga nao encontrada.'];
    //             return $response;
    //         }
    //         $this->vacanceRepository->update($id, ['deleted_at' => now()]);
    //         $response['status'] = 'success';
    //         $response['data'] = ['message' => 'Vaga deletada com sucesso.'];
    //     } catch (\Exception $e) {
    //         $response['status'] = 'error';
    //         $response['exception'] = $this->exception($e, __FILE__, __METHOD__);
    //     }

    //     return $response;
    // }
}

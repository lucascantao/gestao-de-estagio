<?php

namespace App\Services;

use App\Http\DTO\Response\CompanyDTO;
use App\Http\DTO\Response\PageResponseDTO;
use App\Http\DTO\Response\SkillDTO;
use App\Http\DTO\Response\VacanceDTO;
use App\Repositories\Interface\CompanyRepository;
use App\Repositories\Interface\SkillRepository;
use App\utils\traits\ExceptionTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class CompanyService {

    use ExceptionTrait;

    public function __construct(
        protected CompanyRepository $companyRepository
    ) {
    }

    public function getAllCompanies(?int $page = null, ?int $perpage = null): PageResponseDTO | array {
        if($page === null || $perpage === null) {
            return $this->companyRepository->getCompanies()
                ->map(fn($company) => CompanyDTO::fromCompany($company))
                ->toArray();
        }

        $paginator = $this->companyRepository->getAllCompanies($page, $perpage);
        $companies = $paginator
            ->values()
            ->map(fn($company) => CompanyDTO::fromCompany($company))
            ->toArray();

        return PageResponseDTO::fromPaginator($paginator, $companies);
    }

    // public function assignSkillsToUser(array $skillIds, int $userId): array {
    //     $response = [];
    //     $response['metadata'] = null;
    //     $response['exception'] = null;
    //     try {
    //         $this->skillRepository->assignSkillsToUser($skillIds, $userId);
    //         $response['status'] = 'success';
    //         $response['data'] = ['message' => 'Skills atualizadas com sucesso.'];
    //         return $response;   
    //     } catch (Exception $e) {
    //         $response['status'] = 'error';
    //         $response['data'] = null;
    //         $response['exception'] = $this->exception($e, __FILE__, __METHOD__);
    //         return $response;
    //     }
    // }
}

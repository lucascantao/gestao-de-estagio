<?php

namespace App\Http\Controllers;

use App\Http\DTO\Response\APIResponseDTO;
use App\Http\Requests\PageableRequest;
use App\Services\CompanyService;
use App\Services\SkillService;
use Illuminate\Http\Request;

class CompanyController
{

    public function __construct(protected CompanyService $companyService) {
    }

    public function listCompanies(PageableRequest $request) {
        $res = $this->companyService->getAllCompanies(
            $request->query('page'),
            $request->query('perPage')
        );

        return response()->json(APIResponseDTO::fromData(
            [
                'status' => 'success',
                'data' => $res->toArray(),
                'metadata' => null,
                'exception' => null
            ]
        ));
    }

    public function getCompanies() {
        $res = $this->companyService->getAllCompanies();

        return response()->json(APIResponseDTO::fromData(
            [
                'status' => 'success',
                'data' => $res,
                'metadata' => null,
                'exception' => null
            ]
        ));
    }
}

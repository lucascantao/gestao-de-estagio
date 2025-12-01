<?php

namespace App\Http\Controllers;

use App\Http\DTO\Request\StoreInternshipRequestDTO;
use App\Http\DTO\Request\StoreVacanceRequestDTO;
use App\Http\DTO\Request\UpdateInternshipRequestDTO;
use App\Http\DTO\Request\UpdateVacanceRequestDTO;
use App\Http\DTO\Response\APIResponseDTO;
use App\Http\Requests\CreateVacanceRequest;
use App\Http\Requests\UpdateVacanceRequest;
use App\Http\Requests\VacanceRequest;
use App\Services\VacanceService;

class VacanceController
{

    public function __construct(protected VacanceService $vacanceService) {
    }

    public function getVacanceById(int $id) {
        return response()->json(APIResponseDTO::fromData(
            $this->vacanceService->getVacanceById($id)
        ));
    }

    public function getAllVacancies(VacanceRequest $request) {
        $res = $this->vacanceService->getAllVacancies(
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

    public function storeVacance(CreateVacanceRequest $request) {
        return response()
        ->json(APIResponseDTO::fromData(
            $this->vacanceService->storeVacance(
                    StoreVacanceRequestDTO::fromRequest($request->array())
                )
            )
        );
    }

    public function updateVacance(UpdateVacanceRequest $request, int $id) {
        return response()
        ->json(APIResponseDTO::fromData(
            $this->vacanceService->updateVacance($id,
                    UpdateVacanceRequestDTO::fromRequest($request->array()),
                )
            )
        );
    }
}

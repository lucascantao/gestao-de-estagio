<?php

namespace App\Http\Controllers;

use App\Http\DTO\Request\StoreVacanceRequestDTO;
use App\Http\DTO\Request\UpdateVacanceRequestDTO;
use App\Http\DTO\Response\APIResponseDTO;
use App\Http\Requests\CreateVacanceRequest;
use App\Http\Requests\PageableRequest;
use App\Http\Requests\UpdateVacanceRequest;
use App\Http\Requests\VacanceRequest;
use App\Services\SkillService;
use App\Services\VacanceService;
use Illuminate\Http\Request;

class SkillController
{

    public function __construct(protected SkillService $skillService) {
    }

    // public function getVacanceById(int $id) {
    //     return response()->json(APIResponseDTO::fromData(
    //         $this->vacanceService->getVacanceById($id)
    //     ));
    // }

    public function getAllSkills(PageableRequest $request) {
        $res = $this->skillService->getAllSkills(
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

    public function getSkills() {
        $res = $this->skillService->getAllSkills();

        return response()->json(APIResponseDTO::fromData(
            [
                'status' => 'success',
                'data' => $res,
                'metadata' => null,
                'exception' => null
            ]
        ));
    }

    public function updateUserSkills(Request $request, int $userId) {
        return response()->json(APIResponseDTO::fromData(
            $this->skillService->assignSkillsToUser($request->input('skillIds'), $userId)
        ));
    }

    // public function storeVacance(CreateVacanceRequest $request) {
    //     return response()
    //     ->json(APIResponseDTO::fromData(
    //         $this->vacanceService->storeVacance(
    //                 StoreVacanceRequestDTO::fromRequest($request->array())
    //             )
    //         )
    //     );
    // }

    // public function updateVacance(UpdateVacanceRequest $request, int $id) {
    //     return response()
    //     ->json(APIResponseDTO::fromData(
    //         $this->vacanceService->updateVacance($id,
    //                 UpdateVacanceRequestDTO::fromRequest($request->array()),
    //             )
    //         )
    //     );
    // }

    // public function deleteVacance(int $id) {
    //     return response()
    //     ->json(APIResponseDTO::fromData($this->vacanceService->deleteVacance($id)));
    // }
}

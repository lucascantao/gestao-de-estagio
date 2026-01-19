<?php

namespace App\Http\Controllers;

use App\Http\DTO\Response\APIResponseDTO;
use App\Http\Requests\PageableRequest;
use App\Services\SkillService;
use Illuminate\Http\Request;

class SkillController
{

    public function __construct(protected SkillService $skillService) {
    }

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
}

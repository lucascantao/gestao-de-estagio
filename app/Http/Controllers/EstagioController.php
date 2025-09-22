<?php

namespace App\Http\Controllers;

use App\Http\DTO\Response\APIResponseDTO;
use App\Http\Requests\CreateEstagioRequest;
use App\Http\Requests\EstagioRequest;
use App\Services\EstagioService;
use Illuminate\Http\Request;

class EstagioController
{

    public function __construct(protected EstagioService $estagioService) {
    }

    public function getAllEstagios(EstagioRequest $request) {
        $res = $this->estagioService->getAllEstagios(
            $request->query('page'),
            $request->query('perPage')
        );

        return response()->json(APIResponseDTO::fromData(
            [
                'status' => 'success',
                'data' => $res->toArray(),
                'metadata' => null,
                'error' => null
            ]
        ));
    }

    public function storeEstagio(CreateEstagioRequest $request) {
        $res = $this->estagioService->storeEstagio($request->validated());
    }
}

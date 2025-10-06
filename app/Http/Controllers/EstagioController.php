<?php

namespace App\Http\Controllers;

use App\Http\DTO\Request\StoreEstagioRequestDTO;
use App\Http\DTO\Response\APIResponseDTO;
use App\Http\Requests\CreateEstagioRequest;
use App\Http\Requests\EstagioRequest;
use App\Services\EstagioService;

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
                'exception' => null
            ]
        ));
    }

    public function storeEstagio(CreateEstagioRequest $request) {
        return response()
        ->json(APIResponseDTO::fromData(
            $this->estagioService->storeEstagio(
                    StoreEstagioRequestDTO::fromRequest($request->array())
                )
            )
        );
    }
}

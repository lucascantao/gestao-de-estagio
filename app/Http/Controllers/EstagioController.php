<?php

namespace App\Http\Controllers;

use App\Http\DTO\Request\StoreEstagioRequestDTO;
use App\Http\DTO\Request\UpdateEstagioRequestDTO;
use App\Http\DTO\Response\APIResponseDTO;
use App\Http\Requests\CreateEstagioRequest;
use App\Http\Requests\EstagioRequest;
use App\Http\Requests\UpdateEstagioRequest;
use App\Services\EstagioService;
use Illuminate\Http\Request;

class EstagioController
{

    public function __construct(protected EstagioService $estagioService) {
    }

    public function getEstagioById(int $id) {
        return response()->json(APIResponseDTO::fromData(
            $this->estagioService->getEstagioById($id)
        ));
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

    public function updateEstagio(UpdateEstagioRequest $request, int $id) {
        return response()
        ->json(APIResponseDTO::fromData(
            $this->estagioService->updateEstagio($id,
                    UpdateEstagioRequestDTO::fromRequest($request->array()),
                )
            )
        );
    }

    public function updateEstagioStatus(Request $request) {
        return response()
        ->json(APIResponseDTO::fromData(
            $this->estagioService->updateEstagioStatus(
                    $request->input('estagioId'),
                    $request->input('statusId'),
                )
            )
        );
    }
}

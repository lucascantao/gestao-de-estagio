<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstagioRequest;
use App\Services\EstagioService;
use Illuminate\Http\Request;

class EstagioController
{

    public function __construct(protected EstagioService $estagioService) {
    }

    public function getAllEstagios(EstagioRequest $request) {
        $data = $request->validated();
        return response()->json($this->estagioService->getAllEstagios(
            $request->query('page'),
            $request->query('perPage')
        ));
    }
}

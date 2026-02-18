<?php

namespace App\Http\Controllers;

use App\Http\DTO\Request\StoreInternshipRequestDTO;
use App\Http\DTO\Request\UpdateInternshipRequestDTO;
use App\Http\DTO\Response\APIResponseDTO;
use App\Http\Requests\CreateInternshipRequest;
use App\Http\Requests\InternshipDocumentRequest;
use App\Http\Requests\InternshipRequest;
use App\Http\Requests\UpdateInternshipRequest;
use App\Services\InternshipService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InternshipController
{

    public function __construct(protected InternshipService $internshipService) {
    }

    public function getInternshipById(int $id) {
        return response()->json(APIResponseDTO::fromData(
            $this->internshipService->getInternshipById($id)
        ));
    }

    public function getAllInternships(InternshipRequest $request) {
        $res = $this->internshipService->getAllInternships(
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

    public function storeInternship(CreateInternshipRequest $request) {
        $response = APIResponseDTO::fromData(
            $this->internshipService->storeInternship(
                    StoreInternshipRequestDTO::fromRequest($request->array())
                )
            );
        return response()->json($response, $response->code() ?? 500);
    }

    public function updateInternship(UpdateInternshipRequest $request, int $id) {
        return response()
        ->json(APIResponseDTO::fromData(
            $this->internshipService->updateInternship($id,
                    UpdateInternshipRequestDTO::fromRequest($request->array()),
                )
            )
        );
    }

    public function updateInternshipStatus(Request $request) {
        Log::info('Update Internship Status Request: ', $request->all());
        return response()
        ->json(APIResponseDTO::fromData(
            $this->internshipService->updateInternshipStatus(
                    $request->input('id'),
                    $request->input('statusId'),
                )
            )
        );
    }

    public function submitInternshipDocs(InternshipDocumentRequest $request) {
        return response()
        ->json(APIResponseDTO::fromData(
            $this->internshipService->submitInternshipDocs(
                    $request->input('internshipId'),
                    $request->file('file')
                )
            )
        );
    }

    public function downloadInternshipDocument(int $id) {
        return $this->internshipService->downloadInternshipDocument($id);
    }
}

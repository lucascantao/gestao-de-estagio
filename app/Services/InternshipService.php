<?php

namespace App\Services;

use App\Http\DTO\Request\StoreInternshipRequestDTO;
use App\Http\DTO\Request\UpdateInternshipRequestDTO;
use App\Http\DTO\Response\InternshipDTO;
use App\Http\DTO\Response\PageResponseDTO;
use App\Repositories\Interface\CompanyRepository;
use App\Repositories\Interface\DocumentRepository;
use App\Repositories\Interface\InternshipRepository;
use App\utils\traits\ExceptionTrait;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InternshipService {

    use ExceptionTrait;

    public function __construct(
        protected InternshipRepository $intershipRepository,
        protected CompanyRepository $companyRepository,
        protected FileStorageService $fileStorageService,
        protected DocumentRepository $documentRepository
    ) {
    }

    public function getInternshipById(int $id): ?array {
        $response = [];
        $internship = $this->intershipRepository->getInternshipById($id);
        $response['status'] = $internship ? 'success' : 'not_found';
        $response['data'] = $internship ? InternshipDTO::fromIntership($internship)->toArray() : ['message' => 'Estágio não encontrado.'];
        return $response;
    }

    public function getAllInternships(int $page, int $perpage): PageResponseDTO {
        $paginator = $this->intershipRepository->getAllInternships($page, $perpage);
        $internship = $paginator
            ->values()
            ->map(fn($internship) => InternshipDTO::fromIntership($internship))
            ->toArray();

        return PageResponseDTO::fromPaginator($paginator, $internship);
    }

    public function storeInternship(StoreInternshipRequestDTO $internship): array {
        $response = [];
        try {
            DB::transaction(function () use ($internship, &$response) {
                $insertData = $internship->toInsertArray();
                $insertData['internship_status_id'] = 1;
                if($internship->getCompany() !== null) {
                    $newCompany = $this->companyRepository->store($internship->getCompany()->toArray());
                    $insertData['company_id'] = $newCompany->id;
                }
                $this->intershipRepository->store($insertData);
                $response['data'] = ['message' => 'Estágio cadastrado com sucesso.'];
                $response['status'] = 'success';
                $response['code'] = 200;
            });
        } catch (Exception $e) {
            Log::info('Transação finalizada com erro: ' . $e->getMessage());
            $response['code'] = 500;
            $response['status'] = 'error';
            $response['exception'] = $this->exception($e, __FILE__, __METHOD__);
        }

        return $response;
    }

    public function updateInternship(int $id, UpdateInternshipRequestDTO $internship): array {
        $response = [];
        try {
            $updateData = $internship->toUpdateArray();
            $this->intershipRepository->update($id, $updateData);
            $response['data'] = ['message' => 'Estágio atualizado com sucesso.'];
            $response['status'] = 'success';
        } catch (Exception $e) {
            $response['status'] = 'error';
            $response['exception'] = $this->exception($e, __FILE__, __METHOD__);
        }

        return $response;
    }

    public function updateInternshipStatus(int $internshipId, int $statusId): array {
        $response = [];
        try {
            $this->intershipRepository->update($internshipId, ['internship_status_id' => $statusId]);
            $response['data'] = ['message' => 'Status do Estágio atualizado com sucesso.'];
            $response['status'] = 'success';
        } catch (\Exception $e) {
            $response['status'] = 'error';
            $response['exception'] = $this->exception($e, __FILE__, __METHOD__);
        }

        return $response;
    }

    public function submitInternshipDocs(int $internshipId, object $document): array {
        $response = [];
        try {
            $internshipDoc = $this->documentRepository->getDocumentByInternshipId($internshipId);

            $timestamp = now()->format('Y-m-d_H-i-s');
            $extension = $document->getClientOriginalExtension();
            $filename = "{$internshipId}_{$timestamp}.{$extension}";
            $subfolder = "internships/{$internshipId}/documents/";
            $fileContent = file_get_contents($document->getRealPath());
            $userId = $this->intershipRepository->getUserIdByInternshipId($internshipId);

            if($internshipDoc) {
                $this->fileStorageService->deleteFile($internshipDoc->filename, $subfolder);
            }
                
            $this->fileStorageService->storeFile($filename, $fileContent, $subfolder);

            $this->documentRepository->insertDocument([
                'path' => $subfolder . $filename,
                'filename' => $filename,
                'internship_id' => $internshipId,
                'user_id' => $userId,
            ],
            $internshipId);

            $update = $this->updateInternshipStatus($internshipId, 3);
            Log::info('updating', $update);
            
            $response['data'] = ['message' => 'Documentação do Estágio atualizada com sucesso.'];
            $response['status'] = 'success';
        } catch (Exception $e) {
            $response['status'] = 'error';
            $response['exception'] = $this->exception($e, __FILE__, __METHOD__);
        }

        return $response;
    }

    public function downloadInternshipDocument(int $internshipId) {
        $user = Auth::user();
        $internshipDoc = $this->documentRepository->getDocumentByInternshipId($internshipId);
        if(!$internshipDoc || $user->id !== 1) {
            return null;
        }
        $subfolder = "internships/{$internshipId}/documents/";
        return $this->fileStorageService->downloadFile($internshipDoc->filename, $subfolder);
    }
}

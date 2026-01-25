<?php

namespace App\Repositories\Impl;

use App\Models\DocumentModel;
use App\Repositories\Interface\DocumentRepository;

// use App\Models\Estagio;

class DocumentRepositoryImpl extends BaseRepositoryImpl implements DocumentRepository{

    public function __construct(DocumentModel $model) {
        parent::__construct($model);
    }

    public function getDocumentByInternshipId(int $internshipId) {
        $query = $this->model::select(
            'documents.*'
        )
        ->where('internship_id', '=', $internshipId);

        return $query->first();
    }

    public function insertDocument(array $data, int $internshipId): void {
        $document = $this->model::where('internship_id', '=', $internshipId)->first();

        if($document) {
            $this->model::where('internship_id', '=', $internshipId)->update($data);
        } else {
            $this->model::create($data);
        }
    }
}

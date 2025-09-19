<?php

namespace App\Services;

use App\Http\DTO\Response\EstagioDTO;
use App\Http\DTO\Response\PageResponseDTO;
use App\Repositories\Interface\EstagioRepository;

class EstagioService {

    public function __construct(
        protected EstagioRepository $estagioRepository
    ) {}

    public function getAllEstagios(int $page, int $perpage) {
        $paginator = $this->estagioRepository->getAllEstagios($page, $perpage);

        $estagios = $paginator
            ->values()
            ->map(fn($estagio) => EstagioDTO::fromEstagio($estagio))
            ->toArray();

        return PageResponseDTO::fromPaginator($paginator, $estagios);

    }
}

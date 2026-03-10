<?php

namespace App\Http\DTO\Request;

class InternshipRequestFilterDTO {

    public function __construct(
        private ?string $search,
    ) {}

    public static function fromArray(array $filters) {
        return new self(
            $filters['search'] ?? null
        );
    }

    public function getSearch(): ?string {
        return $this->search;
    }
    
}

<?php

namespace App\Http\DTO\Response;

use Illuminate\Pagination\LengthAwarePaginator;
use JsonSerializable;

class PageResponseDTO implements JsonSerializable {
    private int $currentPage;
    private int $perPage;
    private int $total;
    private int $lastPage;
    private array $items;

    public function __construct(int $currentPage, int $perPage, int $total, int $lastPage, array $items) {
        $this->currentPage = $currentPage;
        $this->perPage = $perPage;
        $this->total = $total;
        $this->lastPage = $lastPage;
        $this->items = $items;
    }

    public static function fromPaginator(LengthAwarePaginator $paginator, array $items): PageResponseDTO {
        return new PageResponseDTO(
            $paginator->currentPage(),
            $paginator->perPage(),
            $paginator->total(),
            $paginator->lastPage(),
            $items
        );
    }

    public function toArray(): array {
        return [
            'current_page' => $this->currentPage,
            'per_page' => $this->perPage,
            'total' => $this->total,
            'last_page' => $this->lastPage,
            'items' => $this->items
        ];
    }

    public function jsonSerialize(): array {
        return get_object_vars($this);
    }
}

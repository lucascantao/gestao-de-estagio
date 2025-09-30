<?php

namespace App\Http\DTO\Response;

use Illuminate\Pagination\LengthAwarePaginator;
use JsonSerializable;

class PageResponseDTO implements JsonSerializable {

    public function __construct(
        protected int $page,
        protected int $perPage,
        protected int $total,
        protected int $lastPage,
        protected array $items
    ) { }

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
            'page' => $this->page,
            'perPage' => $this->perPage,
            'total' => $this->total,
            'lastPage' => $this->lastPage,
            'items' => $this->items
        ];
    }

    public function jsonSerialize(): array {
        return get_object_vars($this);
    }
}

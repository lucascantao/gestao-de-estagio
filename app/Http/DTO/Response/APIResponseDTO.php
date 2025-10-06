<?php

namespace App\Http\DTO\Response;

use App\Models\Estagio;
use JsonSerializable;

class APIResponseDTO implements JsonSerializable {

    public function __construct(
        protected string $status,
        protected ?array $data,
        protected ?array $metadata,
        protected ?array $exception
    )
    { }

    public static function fromData(array $data): self {
        return new self(
            $data['status'],
            $data['data'] ?? null,
            $data['metadata'] ?? null,
            $data['exception'] ?? null
        );
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

<?php

namespace App\Http\DTO\Response;

use App\Models\Estagio;
use JsonSerializable;

class APIResponseDTO implements JsonSerializable {

    public function __construct(
        protected ?int $code,
        protected string $status,
        protected ?array $data,
        protected ?array $metadata,
        protected ?array $exception
    )
    { }

    public static function fromData(array $data): self {
        return new self(
            $data['code'] ?? null,
            $data['status'],
            $data['data'] ?? null,
            $data['metadata'] ?? null,
            $data['exception'] ?? null
        );
    }

    public function toArray(): array {
        return [
            'code' => $this->code,
            'status' => $this->status,
            'data' => $this->data,
            'metadata' => $this->metadata,
            'exception' => $this->exception
        ];
    }

    public function code(): ?int {
        return $this->code;
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

<?php

namespace App\Http\DTO\Request;

use App\Models\Estagio;
use JsonSerializable;

class StoreEstagioRequestDTO implements JsonSerializable {

    public function __construct(
        protected string $workload,
        protected string $dayPeriod,
        protected string $startDate,
        protected string $endDate,
        protected float $salary,
        protected int $userId,
        protected ?string $observation,
        protected string $supervisor,
        protected ?int $empresaId,
        protected ?EmpresaDTO $empresa
    )
    { }

    public static function fromRequest(array $request): self {
        if( isset($request['empresa']) ) {
            $empresa = EmpresaDTO::fromRequest($request['empresa']);
        }
        return new self(
            $request['workload'],
            $request['dayPeriod'],
            $request['startDate'],
            $request['endDate'],
            $request['salary'],
            $request['userId'],
            $request['observation'] ?? null,
            $request['supervisor'],
            $request['empresaId'] ?? null,
            $empresa ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'workload' => $this->workload,
            'dayPeriod' => $this->dayPeriod,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'salary' => $this->salary,
            'userId' => $this->userId,
            'observation' => $this->observation,
            'supervisor' => $this->supervisor,
            'empresaId' => $this->empresaId,
            'empresa' => $this->empresa ? $this->empresa->toArray() : null,
        ];
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }

    public function getEmpresa(): ?EmpresaDTO {
        return $this->empresa;
    }
}

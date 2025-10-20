<?php

namespace App\Http\DTO\Request;


use JsonSerializable;

class UpdateInternshipRequestDTO implements JsonSerializable {

    public function __construct(
        protected ?string $workload,
        protected ?string $schedule,
        protected ?string $startDate,
        protected ?string $endDate,
        protected ?float $salary,
        protected ?string $observation,
        protected ?string $supervisor
    )
    { }

    public static function fromRequest(array $request): self {
        return new self(
            $request['workload'] ?? null,
            $request['schedule'] ?? null,
            $request['startDate'] ?? null,
            $request['endDate'] ?? null,
            $request['salary'] ?? null,
            $request['observation'] ?? null,
            $request['supervisor'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'workload' => $this->workload,
            'schedule' => $this->schedule,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'salary' => $this->salary,
            'observation' => $this->observation,
            'supervisor' => $this->supervisor
        ];
    }

    public function toUpdateArray(): array
    {
        return array_filter([
            'workload' => $this->workload,
            'schedule' => $this->schedule,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'salary' => $this->salary,
            'observation' => $this->observation,
            'supervisor' => $this->supervisor
        ], fn($value) => $value !== null);
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

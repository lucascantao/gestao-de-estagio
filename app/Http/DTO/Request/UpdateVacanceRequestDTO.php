<?php

namespace App\Http\DTO\Request;


use JsonSerializable;

class UpdateVacanceRequestDTO implements JsonSerializable {

    public function __construct(
        protected ?string $title,
        protected ?string $description,
        protected ?int $numberOfPositions,
        protected ?string $requirements,
        protected ?string $salary,
        protected ?string $applicationDeadline,
        protected ?bool $active,
    )
    { }

    public static function fromRequest(array $request): self {
        return new self(
            $request['title'] ?? null,
            $request['description'] ?? null,
            $request['number_of_positions'] ?? null,
            $request['requirements'] ?? null,
            $request['salary'] ?? null,
            $request['application_deadline'] ?? null,
            $request['active'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'number_of_positions' => $this->numberOfPositions,
            'requirements' => $this->requirements,
            'salary' => $this->salary,
            'application_deadline' => $this->applicationDeadline,
            'active' => $this->active,
        ];
    }

    public function toUpdateArray(): array
    {
        return array_filter([
            'title' => $this->title,
            'description' => $this->description,
            'number_of_positions' => $this->numberOfPositions,
            'requirements' => $this->requirements,
            'salary' => $this->salary,
            'application_deadline' => $this->applicationDeadline,
            'active' => $this->active,
        ], fn($value) => $value !== null);
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

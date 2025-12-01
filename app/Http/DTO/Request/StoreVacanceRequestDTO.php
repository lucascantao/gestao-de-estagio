<?php

namespace App\Http\DTO\Request;


use JsonSerializable;

class StoreVacanceRequestDTO implements JsonSerializable {

    public function __construct(
        protected string $title,
        protected string $description,
        protected int $numberOfPositions,
        protected ?string $requirements,
        protected ?float $salary,
        protected string $applicationDeadline
    )
    { }

    public static function fromRequest(array $request): self {
        return new self(
            $request['title'],
            $request['description'],
            $request['number_of_positions'],
            $request['requirements'] ?? null,
            $request['salary'] ?? null,
            $request['application_deadline']
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
        ];
    }

    public function toInsertArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'number_of_positions' => $this->numberOfPositions,
            'requirements' => $this->requirements,
            'salary' => $this->salary,
            'application_deadline' => $this->applicationDeadline,
        ];
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

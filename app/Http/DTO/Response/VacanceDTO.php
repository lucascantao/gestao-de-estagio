<?php

namespace App\Http\DTO\Response;

use App\Models\VacanceModel;
use JsonSerializable;

class VacanceDTO implements JsonSerializable {

    public function __construct(
        protected ?string $title,
        protected ?string $description,
        protected ?int $numberOfPositions,
        protected ?string $requirements,
        protected ?float $salary,
        protected ?string $applicationDeadline,
        protected ?bool $active
    )
    { }

    public static function fromIntership(VacanceModel $vacance): self {
        return new self(
            $vacance->title,
            $vacance->description,
            $vacance->number_of_positions,
            $vacance->requirements,
            $vacance->salary,
            $vacance->application_deadline,
            $vacance->active
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

    public function getTitle(): ?string {
        return $this->title;
    }
    public function getDescription(): ?string {
        return $this->description;
    }
    public function getNumberOfPositions(): ?int {
        return $this->numberOfPositions;
    }
    public function getRequirements(): ?string {
        return $this->requirements;
    }
    public function getSalary(): ?float {
        return $this->salary;
    }
    public function getApplicationDeadline(): ?string {
        return $this->applicationDeadline;
    }
    public function isActive(): ?bool {
        return $this->active;
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

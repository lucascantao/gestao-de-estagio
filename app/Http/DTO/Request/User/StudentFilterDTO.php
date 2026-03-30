<?php

namespace App\Http\DTO\Request\User;

use App\Http\Requests\PageableRequest;

class StudentFilterDTO
{
    public function __construct(
        private ?string $search,
        private ?array $skills,
        private ?array $courses,
    ) {}

    public static function fromRequest(PageableRequest $data): self
    {
        $filters = $data->get('filters');
        return new self(
            $filters['search'] ?? null,
            $filters['skills'] ?? null,
            $filters['courses'] ?? null
        );
    }
    public static function fromArray(array $data): self
    {
        return new self(
            $data['search'],
            $data['skills'],
            $data['courses']
        );
    }

    public function getSearch(): ?string
    {
        return $this->search;
    }

    public function getSkills(): ?array
    {
        return $this->skills;
    }

    public function getCourses(): ?array
    {
        return $this->courses;
    }
}

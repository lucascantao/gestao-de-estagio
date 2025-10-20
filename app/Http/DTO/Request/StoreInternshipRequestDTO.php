<?php

namespace App\Http\DTO\Request;


use JsonSerializable;

class StoreInternshipRequestDTO implements JsonSerializable {

    public function __construct(
        protected string $workload,
        protected string $schedule,
        protected string $startDate,
        protected string $endDate,
        protected float $salary,
        protected int $userId,
        protected ?string $observation,
        protected string $supervisor,
        protected ?int $companyId,
        protected ?CompanyDTO $company
    )
    { }

    public static function fromRequest(array $request): self {
        if( isset($request['company']) ) {
            $company = CompanyDTO::fromRequest($request['company']);
        }
        return new self(
            $request['workload'],
            $request['schedule'],
            $request['startDate'],
            $request['endDate'],
            $request['salary'],
            $request['userId'],
            $request['observation'] ?? null,
            $request['supervisor'],
            $request['companyId'] ?? null,
            $company ?? null
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
            'userId' => $this->userId,
            'observation' => $this->observation,
            'supervisor' => $this->supervisor,
            'companyId' => $this->companyId,
            'company' => $this->company ? $this->company->toArray() : null,
        ];
    }

    public function toInsertArray(): array
    {
        return [
            'workload' => $this->workload,
            'schedule' => $this->schedule,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'salary' => $this->salary,
            'users_id' => $this->userId,
            'observation' => $this->observation,
            'supervisor' => $this->supervisor,
            'company_id' => $this->companyId,
        ];
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }

    public function getCompany(): ?CompanyDTO {
        return $this->company;
    }
}

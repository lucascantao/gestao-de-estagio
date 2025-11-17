<?php

namespace App\Http\DTO\Response;

use App\Models\InternshipModel;
use JsonSerializable;

class InternshipDTO implements JsonSerializable {

    public function __construct(
        protected int $id,
        protected string $workload,
        protected string $schedule,
        protected ?string $startDate,
        protected ?string $endDate,
        protected float $salary,
        protected ?string $observation,
        protected ?string $supervisor,
        protected CompanyDTO $company,
        protected InternshipStatusDTO $status,
        protected StudentDTO $user
    )
    { }

    public static function fromIntership(InternshipModel $internship): self {
        $status = new InternshipStatusDTO(
            $internship->internship_status_id,
            $internship->internship_status_name
        );
        $role = new RoleDTO(
            $internship->role_id,
            $internship->role_name
        );
        $course = new CourseDTO(
            $internship->course_id,
            $internship->course_name
        );
        $user = new StudentDTO(
            $internship->student_id,
            $internship->student_name,
            $internship->student_email,
            $internship->student_number,
            $course
        );
        $company = new CompanyDTO(
            $internship->company_id,
            $internship->company_name,
            null,
            null,
            null,
            null
        );

        return new self(
            $internship->id,
            $internship->workload,
            $internship->schedule,
            $internship->start_date,
            $internship->end_date,
            $internship->salary,
            $internship->observation,
            $internship->supervisor,
            $company,
            $status,
            $user
        );
    }

    public static function fromUser(InternshipModel $internship): self {
        $status = new InternshipStatusDTO(
            $internship->internship_status_id,
            $internship->internship_status_name
        );
        $course = new CourseDTO(
            $internship->course_id,
            $internship->course_name
        );
        $user = new StudentDTO(
            null,
            null,
            null,
            $internship->student_number,
            $course
        );
        $company = new CompanyDTO(
            $internship->company_id,
            $internship->company_name,
            null,
            null,
            null,
            null
        );

        return new self(
            $internship->id,
            $internship->workload,
            $internship->schedule,
            null,
            null,
            $internship->salary,
            null,
            null,
            $company,
            $status,
            $user
        );
    }



    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'workload' => $this->workload,
            'schedule' => $this->schedule,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'salary' => $this->salary,
            'observation' => $this->observation,
            'supervisor' => $this->supervisor,
            'company' => $this->company->toArray(),
            'internship_status_id' => $this->status->toArray(),
            'user' => $this->user->toArray()
        ];
    }

    public function toStudentDetailsArray(): array {
        return [
            'id' => $this->id,
            'workload' => $this->workload,
            'schedule' => $this->schedule,
            'salary' => $this->salary,
            'company' => $this->company->toArray(),
            'internship_status' => $this->status->toArray(),
            'student_number' => $this->user->getStudentNumber(),
        ];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getWorkload(): string {
        return $this->workload;
    }

    public function getSchedule(): string {
        return $this->schedule;
    }

    public function getStartDate(): string {
        return $this->startDate;
    }

    public function getEndDate(): string {
        return $this->endDate;
    }

    public function getSalary(): float {
        return $this->salary;
    }

    public function getObservation(): ?string {
        return $this->observation;
    }

    public function getSupervisor(): string {
        return $this->supervisor;
    }

    public function getCompany(): CompanyDTO {
        return $this->company;
    }

    public function getIntershipStatusId(): InternshipStatusDTO {
        return $this->status;
    }

    public function getUser(): StudentDTO {
        return $this->user;
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

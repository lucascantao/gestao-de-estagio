<?php

namespace App\Http\DTO\Response;

use App\Models\Estagio;
use JsonSerializable;

class EstagioDTO implements JsonSerializable {

    public function __construct(
        protected int $id,
        protected string $workload,
        protected string $dayPeriod,
        protected string $startDate,
        protected string $endDate,
        protected float $salary,
        protected ?string $observation,
        protected string $supervisor,
        protected int $empresas_id,
        protected EstagioStatusDTO $status,
        protected UserDTO $user
    )
    { }

    public static function fromEstagio(Estagio $estagio): self {
        $status = new EstagioStatusDTO(
            $estagio->estagio_status_id,
            $estagio->estagio_status_name
        );
        $perfil = new PerfilDTO(
            $estagio->perfil_id,
            $estagio->perfil_name
        );
        $curso = new CursoDTO(
            $estagio->curso_id,
            $estagio->curso_name
        );
        $user = new UserDTO(
            $estagio->user_id,
            $estagio->user_name,
            $estagio->user_email,
            $perfil,
            $curso
        );
        return new self(
            $estagio->id,
            $estagio->workload,
            $estagio->day_period,
            $estagio->start_date,
            $estagio->end_date,
            $estagio->salary,
            $estagio->observation,
            $estagio->supervisor,
            $estagio->empresas_id,
            $status,
            $user
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'workload' => $this->workload,
            'day_period' => $this->dayPeriod,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'salary' => $this->salary,
            'observation' => $this->observation,
            'supervisor' => $this->supervisor,
            'empresas_id' => $this->empresas_id,
            'estagios_status_id' => $this->status->toArray(),
            'user' => $this->user->toArray()
        ];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getWorkload(): string {
        return $this->workload;
    }

    public function getDayPeriod(): string {
        return $this->dayPeriod;
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

    public function getEmpresasId(): int {
        return $this->empresas_id;
    }

    public function getEstagiosStatusId(): EstagioStatusDTO {
        return $this->status;
    }

    public function getUser(): UserDTO {
        return $this->user;
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

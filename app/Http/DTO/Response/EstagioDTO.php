<?php

namespace App\Http\DTO\Response;

use App\Models\Estagio;
use JsonSerializable;

class EstagioDTO implements JsonSerializable {

    public function __construct(
        protected int $id,
        protected string $carga_horaria,
        protected string $horario,
        protected string $data_inicio,
        protected string $data_termino,
        protected float $salario,
        protected ?string $observacao,
        protected string $supervisor,
        protected int $empresas_id,
        protected EstagioStatusDTO $status,
        protected UserDTO $user
    )
    { }

    public static function fromEstagio(Estagio $estagio): self {
        $status = new EstagioStatusDTO(
            $estagio->estagio_status_id,
            $estagio->estagio_status_nome
        );
        $perfil = new PerfilDTO(
            $estagio->perfil_id,
            $estagio->perfil_nome
        );
        $curso = new CursoDTO(
            $estagio->curso_id,
            $estagio->curso_nome
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
            $estagio->carga_horaria,
            $estagio->horario,
            $estagio->data_inicio,
            $estagio->data_termino,
            $estagio->salario,
            $estagio->observacao,
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
            'carga_horaria' => $this->carga_horaria,
            'horario' => $this->horario,
            'data_inicio' => $this->data_inicio,
            'data_termino' => $this->data_termino,
            'salario' => $this->salario,
            'observacao' => $this->observacao,
            'supervisor' => $this->supervisor,
            'empresas_id' => $this->empresas_id,
            'estagios_status_id' => $this->status->toArray(),
            'user' => $this->user->toArray()
        ];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getCargaHoraria(): string {
        return $this->carga_horaria;
    }

    public function getHorario(): string {
        return $this->horario;
    }

    public function getDataInicio(): string {
        return $this->data_inicio;
    }

    public function getDataTermino(): string {
        return $this->data_termino;
    }

    public function getSalario(): float {
        return $this->salario;
    }

    public function getObservacao(): ?string {
        return $this->observacao;
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

<?php

namespace App\Http\DTO\Response;

use App\Models\Estagio;
use App\Models\User;
use JsonSerializable;

class UserDTO implements JsonSerializable {

    public function __construct(
        protected int $id,
        protected string $name,
        protected string $email,
        protected PerfilDTO $perfil,
        protected CursoDTO $curso,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->perfil = $perfil;
        $this->curso = $curso;
    }

    public static function fromUser(User $user): self {
        return new self(
            $user->id,
            $user->name,
            $user->email,
            PerfilDTO::fromUser($user),
            CursoDTO::fromUser($user),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'perfil' => $this->perfil->toArray(),
            'curso' => $this->curso->toArray(),
        ];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPerfil(): PerfilDTO {
        return $this->perfil;
    }

    public function getCurso(): CursoDTO {
        return $this->curso;
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

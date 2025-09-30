<?php

namespace App\Http\DTO\Response;

use App\Models\Estagio;
use App\Models\User;
use JsonSerializable;

class PerfilDTO implements JsonSerializable {

    public function __construct(
        protected int $id,
        protected string $nome
    )
    { }

    public static function fromUser(object $user): self {
        return new self(
            $user->perfil_id,
            $user->perfil_nome,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome
        ];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

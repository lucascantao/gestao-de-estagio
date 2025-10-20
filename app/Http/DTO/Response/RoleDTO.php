<?php

namespace App\Http\DTO\Response;

use JsonSerializable;

class RoleDTO implements JsonSerializable {

    public function __construct(
        protected int $id,
        protected string $name
    )
    { }

    public static function fromUser(object $user): self {
        return new self(
            $user->role_id,
            $user->role_name,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

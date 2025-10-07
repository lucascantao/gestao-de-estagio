<?php

namespace App\Http\DTO\Response\User;

use App\Core\Models\User\RoleModel;
use JsonSerializable;

class UserRoleDTO implements JsonSerializable{
    public function __construct(
        private int $id,
        private string $name
    ) {}

    public static function fromRole(RoleModel $role): self
    {
        return new self(
            $role->getAttribute('id'),
            $role->getAttribute('name')
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

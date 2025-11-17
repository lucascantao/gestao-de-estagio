<?php

namespace App\Http\DTO\Response\User;

use App\Models\UserModel;
use Illuminate\Support\Carbon;
use JsonSerializable;
use stdClass;

class UserDTO implements JsonSerializable {
    private ?UserRoleDTO $role;

    public function __construct(
        private ?int $id,
        private ?string $name,
        private ?string $email,
        ?int $roleId,
        ?string $roleName,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->role = ($roleId != null || $roleName != null) ? new UserRoleDTO($roleId, $roleName) : null;
    }

    public static function fromUser(UserModel $user): self {
        return new self(
            $user->getAttribute('id'),
            $user->getAttribute('name'),
            $user->getAttribute('email'),
            $user->getAttribute('role_id'),
            $user->getAttribute('role_name'),
        );
    }

    public static function fromUserStdClass(stdClass $user): self {
        return new self(
            $user->id ?? null,
            $user->name ?? null,
            $user->email ?? null,
            $user->role_id ?? null,
            $user->role_name ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role->toArray(),
        ];
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

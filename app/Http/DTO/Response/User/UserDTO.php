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
        private ?string $phone,
        private ?string $address,
        private ?string $birthdate,
        private ?string $gender,
        ?int $roleId,
        ?string $roleName,
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->birthdate = $birthdate;
        $this->gender = $gender;
        $this->role = ($roleId != null || $roleName != null) ? new UserRoleDTO($roleId, $roleName) : null;
    }

    public static function fromUser(UserModel $user): self {
        return new self(
            $user->getAttribute('id'),
            $user->getAttribute('name'),
            $user->getAttribute('email'),
            $user->getAttribute('phone'),
            $user->getAttribute('address'),
            $user->getAttribute('birthdate'),
            $user->getAttribute('gender'),
            $user->getAttribute('role_id'),
            $user->getAttribute('role_name'),
        );
    }

    public static function fromUserStdClass(stdClass $user): self {
        return new self(
            $user->id ?? null,
            $user->name ?? null,
            $user->email ?? null,
            $user->phone ?? null,
            $user->address ?? null,
            $user->birthdate ?? null,
            $user->gender ?? null,
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
            'phone'=> $this->phone,
            'address'=> $this->address,
            'birthdate'=> $this->birthdate,
            'gender'=> $this->gender,
            'role' => $this->role ? $this->role->toArray() : null,
        ];
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

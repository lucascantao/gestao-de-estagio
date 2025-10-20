<?php

namespace App\Http\DTO\Response\User;

use App\Models\UserModel;
use Illuminate\Support\Carbon;
use JsonSerializable;
use stdClass;

class UserDTO implements JsonSerializable {
    private ?UserRoleDTO $role;
    private ?string $partnerName;
    private ?int $partnerId;

    public function __construct(
        private ?int $id,
        private ?string $name,
        private ?string $email,
        // private ?string $createdAt,
        // private ?string $updatedAt,
        ?int $perfilId,
        ?string $perfilName,
        ?string $roleDescription,
        ?int $partnerId,
        ?string $partnerName,
        private ?string $phone,
        private ?string $address,
        private ?array $courses,
        private ?int $enable,
        private ?string $status
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        // $this->createdAt = $createdAt ?? null;
        // $this->updatedAt = $updatedAt ?? null;
        $this->role = ($perfilId != null || $perfilName != null) ? new UserRoleDTO($perfilId, $perfilName, $roleDescription) : null;
        $this->partnerId = $partnerId;
        $this->partnerName = $partnerName;
        $this->phone = $phone;
        $this->address = $address;
        $this->enable = $enable;
    }

    public static function fromUser(UserModel $user): self {
        return new self(
            $user->getAttribute('id'),
            $user->getAttribute('name'),
            $user->getAttribute('email'),
            // $user->getAttribute('created_at'),
            // $user->getAttribute('updated_at'),
            $user->getAttribute('role_id'),
            $user->getAttribute('role_name'),
            $user->getAttribute('roles_description'),
            $user->getAttribute('partners_id'),
            $user->getAttribute('partners_name'),
            $user->getAttribute('phone_number'),
            $user->getAttribute('address'),
            null,
            $user->getAttribute('enable'),
            $user->getAttribute('user_status'),
        );
    }

    public static function fromUserStdClass(stdClass $user): self {
        return new self(
            $user->id ?? null,
            $user->name ?? null,
            $user->email ?? null,
            // $user->created_at ?? null,
            // $user->updated_at ?? null,
            $user->roles_id ?? null,
            $user->roles_name ?? null,
            $user->roles_description ?? null,
            $user->partners_id ?? null,
            $user->partners_name ?? null,
            $user->phone_number ?? null,
            $user->address ?? null,
            null,
            $user->enable ?? null,
            $user->user_status ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'partners_id' => $this->partnerId,
            'partners_name' => $this->partnerName,
            // 'createdAt' => $this->createdAt,
            // 'updatedAt' => $this->updatedAt,
            'role' => $this->role->toArray(),
            'enable' => $this->enable
        ];
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

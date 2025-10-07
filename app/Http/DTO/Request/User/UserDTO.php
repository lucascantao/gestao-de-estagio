<?php

namespace App\Http\DTO\Request\User;

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
        private ?string $createdAt,
        private ?string $updatedAt,
        ?int $roleId,
        ?string $roleName,
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
        $this->createdAt = $createdAt ?? null;
        $this->updatedAt = $updatedAt ?? null;
        $this->role = ($roleId != null || $roleName != null) ? new UserRoleDTO($roleId, $roleName, $roleDescription) : null;
        $this->partnerId = $partnerId;
        $this->partnerName = $partnerName;
        $this->phone = $phone;
        $this->address = $address;
        $this->enable = $enable;
    }

    public static function fromUserFacilitator(UserModel $user): self {
        return new self(
            $user->getAttribute('id'),
            $user->getAttribute('name'),
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            $user->getAttribute('phone_number'),
            null,
            null,
            null,
            null,
        );
    }

    public static function fromUser(UserModel $user): self {
        return new self(
            $user->getAttribute('id'),
            $user->getAttribute('name'),
            $user->getAttribute('email'),
            $user->getAttribute('created_at'),
            $user->getAttribute('updated_at'),
            $user->getAttribute('roles_id'),
            $user->getAttribute('roles_name'),
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
            $user->created_at ?? null,
            $user->updated_at ?? null,
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

    public static function fromUserModelWithCourses(UserModel $user): self {
        $coursesString = $user->getAttribute('courses');
        $coursesArray = null;

        if ($coursesString !== null) {
            $coursesArray = explode(', ', $coursesString);
        }

        return new self(
            $user->getAttribute('id'),
            $user->getAttribute('name'),
            $user->getAttribute('email'),
            $user->getAttribute('created_at'),
            $user->getAttribute('updated_at'),
            $user->getAttribute('roles_id'),
            $user->getAttribute('roles_name'),
            $user->getAttribute('roles_description'),
            $user->getAttribute('partners_id'),
            $user->getAttribute('partners_name'),
            $user->getAttribute('phone_number'),
            $user->getAttribute('address'),
            $coursesArray,
            $user->getAttribute('enable'),
            $user->getAttribute('user_status'),
        );
    }

    public static function fromUserAndRoleModel(UserModel $user): self {
        return new self(
            $user->getAttribute('id'),
            $user->getAttribute('name'),
            $user->getAttribute('email'),
            $user->getAttribute('created_at'),
            $user->getAttribute('updated_at'),
            $user->getAttribute('roles_id'),
            $user->getAttribute('roles_name'),
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
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'role' => $this->role->toArray(),
            'enable' => $this->enable
        ];
    }

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): string {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }

    public function getRole(): UserRoleDTO {
        return $this->role;
    }

    public function setRole(UserRoleDTO $role): void {
        $this->role = $role;
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }

    public function getEnable(): int {
        return $this->enable;
    }

    public function setEnable(int $enable): void {
        $this->enable = $enable;
    }

    public function getPartnerId(): int {
        return $this->partnerId;
    }
}

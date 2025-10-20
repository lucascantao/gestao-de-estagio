<?php

namespace App\Http\DTO\Response;

use App\Models\Estagio;
use App\Models\UserModel;
use JsonSerializable;

class UserDTO implements JsonSerializable {

    public function __construct(
        protected int $id,
        protected string $name,
        protected string $email,
        protected RoleDTO $role,
        protected CourseDTO $course,
    )
    { }

    public static function fromUser(UserModel $user): self {
        return new self(
            $user->id,
            $user->name,
            $user->email,
            RoleDTO::fromUser($user),
            CourseDTO::fromUser($user),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role->toArray(),
            'course' => $this->course->toArray(),
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

    public function getRole(): RoleDTO {
        return $this->role;
    }

    public function getCourse(): CourseDTO {
        return $this->course;
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

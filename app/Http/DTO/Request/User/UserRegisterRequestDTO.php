<?php

namespace App\Http\DTO\Request\User;

use Illuminate\Support\Facades\Hash;

class UserRegisterRequestDTO {

    public function __construct(
        protected string $name,
        protected string $email,
        protected string $password,
        protected ?int $roleId,
        protected ?int $courseId,
        protected ?string $phone,
        protected ?string $address,
        protected ?string $birthdate,
        protected ?string $gender
    ) { }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['email'],
            $data['password'],
            $data['roleId'] ?? null,
            $data['courseId'] ?? null,
            $data['phone'] ?? null,
            $data['address'] ?? null,
            $data['birthdate'] ?? null,
            $data['gender'] ?? null
        );
    }

    public function toInsertArray(): array {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_id' => $this->roleId,
            'course_id' => $this->courseId,
            'address' => $this->address,
            'phone' => $this->phone,
            'birthdate' => $this->birthdate,
            'gender'=> $this->gender
        ];
    }

    public function getName(): string {
        return $this->name;
    }
    public function getEmail(): string {
        return $this->email;
    }
    public function getPassword(): string {
        return $this->password;
    }
    public function getRoleId(): ?int {
        return $this->roleId;
    }
    public function getCursoId(): ?int {
        return $this->courseId;
    }
    public function setRoleId(?int $roleId) {
        $this->roleId = $roleId;
    }

    public function getAddress(): ?string {
        return $this->address;
    }
    public function getPhone(): ?string {
        return $this->phone;
    }
    public function getBirthdate(): ?string {
        return $this->birthdate;
    }
    public function getGender(): ?string {
        return $this->gender;
    }

}

<?php

namespace App\Http\DTO\Request\User;

use Illuminate\Support\Facades\Hash;

class UserRegisterRequestDTO {

    public function __construct(
        protected string $name,
        protected string $email,
        protected string $password,
        protected int $profileId,
        protected int $cursoId,
        // string $address,
        // string $phoneNumber,
        // ?string $birthdate = null,
        // ?string $gender = null
    ) { }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['email'],
            $data['password'],
            $data['roleId'],
            $data['cursoId'],
            // $data['address'],
            // $data['phone'],
            // $data['birthdate'] ?? null,
            // $data['gender'] ?? null
        );
    }

    public function toInsertArray(): array {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_id' => $this->profileId,
            'course_id' => $this->cursoId,
            // 'address' => $this->address,
            // 'phone_number' => $this->phoneNumber,
            // 'birthdate' => $this->birthdate,
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
    public function getProfileId(): int {
        return $this->profileId;
    }
    public function getCursoId(): int {
        return $this->cursoId;
    }

}

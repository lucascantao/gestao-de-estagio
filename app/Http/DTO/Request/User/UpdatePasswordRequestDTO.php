<?php

namespace App\Http\DTO\Request\User;

class UpdatePasswordRequestDTO
{
    public function __construct(
        public int $userId,
        public string $currentPassword,
        public string $password
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['userId'],
            $data['currentPassword'],
            $data['password']
        );
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getCurrentPassword(): string
    {
        return $this->currentPassword;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}

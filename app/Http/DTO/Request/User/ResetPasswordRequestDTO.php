<?php

namespace App\Http\DTO\Request\User;

class ResetPasswordRequestDTO {

    public function __construct(
        public string $email,
        public string $token,
        public string $password
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['email'],
            $data['token'],
            $data['password']
        );
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}

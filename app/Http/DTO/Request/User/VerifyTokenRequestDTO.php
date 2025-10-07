<?php

namespace App\Http\DTO\Request\User;

class VerifyTokenRequestDTO
{
    public function __construct(
        public string $email,
        public string $token
    ) {
        $this->token = strtoupper($token);
    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['email'],
            $data['token']
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
}

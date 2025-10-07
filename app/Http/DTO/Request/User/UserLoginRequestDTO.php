<?php

namespace App\Http\DTO\Request\User;

class UserLoginRequestDTO
{
    private string $email;
    private string $password;

    private ?string $platform;

    public function __construct(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}

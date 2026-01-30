<?php

namespace App\Http\DTO\Request\User;

use Illuminate\Contracts\Session\Session;

class UserLoginRequestDTO
{
    private string $email;
    private string $password;

    private Session $session;

    public function __construct(string $email, string $password, Session $session) {
        $this->email = $email;
        $this->password = $password;
        $this->session = $session;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getSession(): Session
    {
        return $this->session;
    }
}

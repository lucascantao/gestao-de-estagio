<?php

namespace App\Http\DTO\Response\User;

use App\Models\UserModel;
use JsonSerializable;

class UserAuthResponseDTO implements JsonSerializable {
    private string $message;
    private UserDTO $user;
    private ?string $token;

    public function __construct(
        string    $message,
        UserModel $user,
        ?string   $token
    ) {
        $this->message = $message;
        $this->user = UserDTO::fromUser($user);
        $this->token = $token ?? null;
    }

    public static function fromAuthSuccess(string $message, UserModel $user, ?string $token): self
    {
        return new self(
            $message,
            $user,
            $token
        );
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'user' => $this->user->toArray(),
            'token' => $this->token ?? null
        ];
    }

    public function jsonSerialize(): array {
        return get_object_vars($this);
    }
}

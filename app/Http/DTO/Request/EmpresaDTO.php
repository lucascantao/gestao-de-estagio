<?php

namespace App\Http\DTO\Request;

use App\Models\Estagio;
use JsonSerializable;

class EmpresaDTO implements JsonSerializable {

    public function __construct(
        protected ?string $name,
        protected ?string $address,
        protected ?string $cnpj,
        protected ?string $email,
        protected ?string $phone,
    )
    { }

    public static function fromRequest(array $request): self {
        return new self(
            $request['name'],
            $request['address'],
            $request['cnpj'],
            $request['email'],
            $request['phone'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'cnpj' => $this->cnpj,
            'email' => $this->email,
            'phone' => $this->phone,
        ];
    }

    public function getName(): ?string {
        return $this->name;
    }
    public function getAddress(): ?string {
        return $this->address;
    }
    public function getCnpj(): ?string {
        return $this->cnpj;
    }
    public function getEmail(): ?string {
        return $this->email;
    }
    public function getPhone(): ?string {
        return $this->phone;
    }
    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

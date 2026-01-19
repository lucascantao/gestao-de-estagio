<?php

namespace App\Http\DTO\Response;


use JsonSerializable;

class CompanyDTO implements JsonSerializable {

    public function __construct(
        protected int $id,
        protected string $name,
        protected ?string $cnpj,
        protected ?string $address,
        protected ?string $email,
        protected ?string $phone
    )
    { }

    public static function fromUser(object $user): self {
        return new self(
            $user->course_id,
            $user->course_name,
            $user->cnpj ?? null,
            $user->address ?? null,
            $user->email ?? null,
            $user->phone ?? null
        );
    }

    public static function fromCompany(object $company): self {
        return new self(
            $company->id,
            $company->name,
            $company->cnpj ?? null,
            $company->address ?? null,
            $company->email ?? null,
            $company->phone ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'cnpj' => $this->cnpj,
            'address' => $this->address,
            'email' => $this->email,
            'phone' => $this->phone
        ];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getCnpj(): ?string {
        return $this->cnpj;
    }
    public function getAddress(): ?string {
        return $this->address;
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

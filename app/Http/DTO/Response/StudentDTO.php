<?php

namespace App\Http\DTO\Response;

use App\Models\Estagio;
use App\Models\UserModel;
use JsonSerializable;

class StudentDTO implements JsonSerializable {

    public function __construct(
        protected ?int $id,
        protected ?string $name,
        protected ?string $email,
        protected ?string $phone,
        protected ?string $address,
        protected ?string $birthdate,
        protected ?string $gender,
        protected ?string $studentNumber,
        protected ?CourseDTO $course,
    )
    { }

    public static function fromUser(UserModel $user): self {
        return new self(
            $user->id,
            $user->name,
            $user->email,
            $user->phone,
            $user->address,
            $user->birthdate,
            $user->gender,
            $user->student_number,
            CourseDTO::fromUser($user),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone'=> $this->phone,
            'address'=> $this->address,
            'birthdate'=> $this->birthdate,
            'gender'=> $this->gender,
            'studentNumber' => $this->studentNumber,
            'course' => $this->course->toArray(),
        ];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPhone(): string {
        return $this->phone;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function getBirthDate(): string {
        return $this->birthdate;
    }

    public function getGender(): string {
        return $this->gender;
    }

    public function getStudentNumber(): string {
        return $this->studentNumber;
    }

    public function getCourse(): CourseDTO {
        return $this->course;
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

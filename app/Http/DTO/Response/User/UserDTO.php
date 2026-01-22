<?php

namespace App\Http\DTO\Response\User;

use App\Models\UserModel;
use Illuminate\Support\Carbon;
use JsonSerializable;
use stdClass;

class UserDTO implements JsonSerializable {
    private ?UserRoleDTO $role;
    private ?UserCourseDTO $course;

    public function __construct(
        private ?int $id,
        private ?string $name,
        private ?string $email,
        private ?string $phone,
        private ?string $address,
        private ?string $birthdate,
        private ?string $gender,
        private ?string $student_number,
        ?int $roleId,
        ?string $roleName,
        ?int $courseId,
        ?string $courseName
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->birthdate = $birthdate;
        $this->gender = $gender;
        $this->student_number = $student_number;
        $this->role = ($roleId != null || $roleName != null) ? new UserRoleDTO($roleId, $roleName) : null;
        $this->course = ($courseId != null || $courseName != null) ? new UserCourseDTO($courseId, $courseName) : null;
    }

    public static function fromUser(UserModel $user): self {
        return new self(
            $user->getAttribute('id'),
            $user->getAttribute('name'),
            $user->getAttribute('email'),
            $user->getAttribute('phone'),
            $user->getAttribute('address'),
            $user->getAttribute('birthdate'),
            $user->getAttribute('gender'),
            $user->getAttribute('student_number'),
            $user->getAttribute('role_id'),
            $user->getAttribute('role_name'),
            $user->getAttribute('course_id'),
            $user->getAttribute('course_name'),
        );
    }

    public static function fromUserStdClass(stdClass $user): self {
        return new self(
            $user->id ?? null,
            $user->name ?? null,
            $user->email ?? null,
            $user->phone ?? null,
            $user->address ?? null,
            $user->birthdate ?? null,
            $user->gender ?? null,
            $user->student_number ?? null,
            $user->role_id ?? null,
            $user->role_name ?? null,
            $user->course_id ?? null,
            $user->course_name ?? null
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
            'student_number'=> $this->student_number,
            'role' => $this->role ? $this->role->toArray() : null,
            'course' => $this->course ? $this->course->toArray() : null
        ];
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

<?php

namespace App\Http\DTO\Response\User;

use App\Core\Models\User\RoleModel;
use App\Models\CourseModel;
use JsonSerializable;

class UserCourseDTO implements JsonSerializable{
    public function __construct(
        private int $id,
        private string $name
    ) {}

    public static function fromRole(CourseModel $course): self
    {
        return new self(
            $course->getAttribute('id'),
            $course->getAttribute('name')
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

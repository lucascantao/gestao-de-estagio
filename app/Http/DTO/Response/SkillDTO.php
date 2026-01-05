<?php

namespace App\Http\DTO\Response;

use App\Models\SkillModel;
use JsonSerializable;

class SkillDTO implements JsonSerializable {

    public function __construct(
        protected ?int $id,
        protected ?string $name,
        protected ?string $description
    )
    { }

    public static function fromSkill(SkillModel $skill): self {
        return new self(
            $skill->id,
            $skill->name,
            $skill->description
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description
        ];
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

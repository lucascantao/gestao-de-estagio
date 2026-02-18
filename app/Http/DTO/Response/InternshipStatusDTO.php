<?php

namespace App\Http\DTO\Response;

use JsonSerializable;

class InternshipStatusDTO implements JsonSerializable {

    public function __construct(
        protected int $id,
        protected string $name,
        protected ?string $description = null,
        protected ?string $textColor = null,
        protected ?string $backgroundColor = null
    )
    { }

    // public static function fromUser(object $user): self {
    //     return new self(
    //         $user->status_id,
    //         $user->status_name,
    //         $user->status_description ?? null,
    //         $user->status_text_color ?? null,
    //         $user->status_background_color ?? null
    //     );
    // }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'text_color' => $this->textColor,
            'background_color' => $this->backgroundColor
        ];
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): ?string {
        return $this->description;
    }

    public function getTextColor(): ?string {
        return $this->textColor;
    }

    public function getBackgroundColor(): ?string {
        return $this->backgroundColor;
    }

    public function jsonSerialize(): mixed {
        return get_object_vars($this);
    }
}

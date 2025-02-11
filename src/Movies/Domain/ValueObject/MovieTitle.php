<?php

declare(strict_types=1);

namespace Movies\Domain\ValueObject;

final readonly class MovieTitle
{
    public function __construct(
        public string $title,
    ) {
        $this->guard();
    }

    public function startsWithW(): bool
    {
        return 'W' === \mb_strtoupper($this->title)[0];
    }

    public function hasEvenCharacterCount(): bool
    {
        return 0 === \mb_strlen($this->title, 'UTF-8') % 2;
    }

    public function hasMoreThanOneWord(): bool
    {
        return 1 < \count(\explode(' ', $this->title));
    }

    private function guard(): void
    {
        if (!trim($this->title)) {
            throw new \InvalidArgumentException('Movie title cannot be empty');
        }
    }
}
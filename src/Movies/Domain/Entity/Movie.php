<?php

declare(strict_types=1);

namespace Movies\Domain\Entity;

use Movies\Domain\ValueObject\MovieTitle;

final readonly class Movie
{
    public function __construct(
        private MovieTitle $title,
    ) {
    }

    public function getTitle(): MovieTitle
    {
        return $this->title;
    }
}
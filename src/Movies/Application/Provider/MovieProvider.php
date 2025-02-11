<?php

declare(strict_types=1);

namespace Movies\Application\Provider;

use Movies\Domain\Entity\Movie;

interface MovieProvider
{
    /**
     * @return iterable<int,Movie>
     */
    public function getMovies(): iterable;

    public function getMoviesCount(): int;
}

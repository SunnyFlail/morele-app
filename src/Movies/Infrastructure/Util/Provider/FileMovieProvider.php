<?php

declare(strict_types = 1);

namespace Movies\Infrastructure\Util\Provider;

use Movies\Application\Provider\MovieProvider;
use Movies\Domain\Entity\Movie;
use Movies\Domain\ValueObject\MovieTitle;

final readonly class FileMovieProvider implements MovieProvider
{
    public function __construct(
        private string $pathToFile = __DIR__ . '/movies.php'
    ) {
    }

    public function getMovies(): iterable
    {
        foreach ($this->importMovies() as $movie) {
            yield new Movie(new MovieTitle($movie));
        }
    }

    public function getMoviesCount(): int
    {
        return \count($this->importMovies());
    }

    /**
     * @return string[]
     */
    private function importMovies(): array
    {
       return require $this->pathToFile;
    }
}

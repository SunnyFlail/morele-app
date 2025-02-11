<?php

declare(strict_types=1);

namespace Movies\Infrastructure\Util\RecommendationAlgorithm;

use Movies\Application\Provider\MovieProvider;
use Movies\Domain\RecommendationAlgorithm\RecommendationAlgorithm;

final readonly class MoviesWithMoreThanOneWordInTitleAlgorithm implements RecommendationAlgorithm
{
    public function __construct(
        private MovieProvider $movieProvider,
    ) {
    }

    public function findMovies(): iterable
    {
        foreach ($this->movieProvider->getMovies() as $movie) {
            $title = $movie->getTitle();

            if (true === $title->hasMoreThanOneWord()) {
                yield $movie;
            }
        }
    }
}
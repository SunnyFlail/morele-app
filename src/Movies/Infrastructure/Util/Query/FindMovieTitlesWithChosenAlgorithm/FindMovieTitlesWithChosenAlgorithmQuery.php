<?php

declare(strict_types=1);

namespace Movies\Infrastructure\Util\Query\FindMovieTitlesWithChosenAlgorithm;

use Movies\Application\MovieSearcher\MovieSearcher;
use Movies\Application\Query\FindMovieTitlesWithChosenAlgorithm\FindMovieTitlesWithChosenAlgorithmQuery as QueryInterface;
use Movies\Domain\RecommendationAlgorithm\RecommendationAlgorithmType;

final readonly class FindMovieTitlesWithChosenAlgorithmQuery implements QueryInterface
{
    public function __construct(
        private MovieSearcher $movieSearcher,
    ) {
    }

    public function execute(RecommendationAlgorithmType $algorithmType): iterable
    {
        foreach ($this->movieSearcher->search($algorithmType) as $movie) {
            yield $movie->getTitle()->title;
        }
    }
}
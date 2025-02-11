<?php

declare(strict_types=1);

namespace Movies\Infrastructure\Util\RecommendationAlgorithm;

use Movies\Application\Provider\MovieProvider;
use Movies\Application\Randomizer\IndexRandomizer;
use Movies\Domain\RecommendationAlgorithm\RecommendationAlgorithm;
use Movies\Domain\RecommendationAlgorithm\TooFewAvailableMoviesException;

final readonly class ThreeRandomMoviesAlgorithm implements RecommendationAlgorithm
{
    private const int REQUIRED_RESULTS = 3;

    public function __construct(
        private MovieProvider $movieProvider,
        private IndexRandomizer $indexRandomizer,
    ) {
    }

    public function findMovies(): iterable
    {
        $count = $this->movieProvider->getMoviesCount();

        if (self::REQUIRED_RESULTS > $count) {
            throw new TooFewAvailableMoviesException();
        }

        $indexes = [];

        for ($i = 0; self::REQUIRED_RESULTS > $i; $i++) {
            $randomIndex = $this->indexRandomizer->getUniqueRandomIndex($count, $indexes);
            $indexes[$randomIndex] = true;
        }
        $returnedResults = 0;

        foreach ($this->movieProvider->getMovies() as $movieIndex => $movie) {
            if (true === isset($indexes[$movieIndex])) {
                $returnedResults++;

                yield $movie;
            }

            if (self::REQUIRED_RESULTS === $returnedResults) {
                break;
            }
        }
    }
}
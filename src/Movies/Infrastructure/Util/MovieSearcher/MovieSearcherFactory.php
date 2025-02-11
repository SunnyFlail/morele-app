<?php

declare(strict_types = 1);

namespace Movies\Infrastructure\Util\MovieSearcher;

use Movies\Domain\RecommendationAlgorithm\RecommendationAlgorithmType;
use Movies\Infrastructure\Util\RecommendationAlgorithm\MoviesStartingWithWAndEvenNumberOfCharactersAlgorithm;
use Movies\Infrastructure\Util\RecommendationAlgorithm\MoviesWithMoreThanOneWordInTitleAlgorithm;
use Movies\Infrastructure\Util\RecommendationAlgorithm\ThreeRandomMoviesAlgorithm;

final readonly class MovieSearcherFactory
{
    public function __construct(
        private ThreeRandomMoviesAlgorithm $threeRandomMoviesAlgorithm,
        private MoviesStartingWithWAndEvenNumberOfCharactersAlgorithm $startingWithWAndEvenNumberOfCharactersAlgorithm,
        private MoviesWithMoreThanOneWordInTitleAlgorithm $withMoreThanOneWordInTitleAlgorithm,
    ) {
    }

    public function create(): MovieSearcher
    {
        $searcher = new MovieSearcher();

        $searcher->addAlgorithm(
            RecommendationAlgorithmType::THREE_RANDOM_MOVIES,
            $this->threeRandomMoviesAlgorithm,
        );
        $searcher->addAlgorithm(
            RecommendationAlgorithmType::MOVIES_STARTING_WITH_W_AND_EVEN_NUMBER_OF_CHARACTERS,
            $this->startingWithWAndEvenNumberOfCharactersAlgorithm,
        );
        $searcher->addAlgorithm(
            RecommendationAlgorithmType::MOVIES_WITH_MORE_THAN_ONE_WORD,
            $this->withMoreThanOneWordInTitleAlgorithm,
        );

        return $searcher;
    }
}
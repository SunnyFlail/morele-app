<?php

declare(strict_types = 1);

namespace Movies\Infrastructure\Util\MovieSearcher;

use Movies\Application\MovieSearcher\MovieSearcher as MovieSearcherInterface;
use Movies\Application\MovieSearcher\UnsupportedAlgorithmException;
use Movies\Domain\RecommendationAlgorithm\RecommendationAlgorithm;
use Movies\Domain\RecommendationAlgorithm\RecommendationAlgorithmType;

final class MovieSearcher implements MovieSearcherInterface
{
    /**
     * @var array<int,RecommendationAlgorithm>
     */
    private array $algorithms = [];

    /**
     * @throws \LogicException
     */
    public function addAlgorithm(
        RecommendationAlgorithmType $algorithmType,
        RecommendationAlgorithm $algorithm,
    ): void {
        if (true === isset($this->algorithms[$algorithmType->name])) {
            throw new \LogicException(sprintf(
                'Algorithm %s has already been added.',
                $algorithmType->name,
            ));
        }

        $this->algorithms[$algorithmType->name] = $algorithm;
    }

    public function search(RecommendationAlgorithmType $algorithmType): iterable
    {
        if (false === isset($this->algorithms[$algorithmType->name])) {
            throw new UnsupportedAlgorithmException($algorithmType);
        }

        return $this->algorithms[$algorithmType->name]->findMovies();
    }
}

<?php

declare(strict_types=1);

namespace Movies\Domain\RecommendationAlgorithm;

use Movies\Domain\Entity\Movie;

interface RecommendationAlgorithm
{
    /**
     * @throws AlgorithmExceptionInterface
     *
     * @return iterable<Movie>
     */
    public function findMovies(): iterable;
}
<?php

declare(strict_types=1);

namespace Movies\Application\MovieSearcher;

use Movies\Domain\Entity\Movie;
use Movies\Domain\RecommendationAlgorithm\RecommendationAlgorithm;
use Movies\Domain\RecommendationAlgorithm\RecommendationAlgorithmType;

interface MovieSearcher
{
    /**
     * @throws UnsupportedAlgorithmException
     *
     * @return iterable<Movie>
     */
    public function search(RecommendationAlgorithmType $algorithmType): iterable;
}
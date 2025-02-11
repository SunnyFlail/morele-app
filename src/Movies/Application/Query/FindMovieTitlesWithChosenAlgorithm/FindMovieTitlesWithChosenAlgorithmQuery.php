<?php

declare(strict_types=1);

namespace Movies\Application\Query\FindMovieTitlesWithChosenAlgorithm;

use Movies\Domain\RecommendationAlgorithm\RecommendationAlgorithmType;

interface FindMovieTitlesWithChosenAlgorithmQuery
{
    /**
     * @return iterable<string>
     */
    public function execute(RecommendationAlgorithmType $algorithmType): iterable;
}
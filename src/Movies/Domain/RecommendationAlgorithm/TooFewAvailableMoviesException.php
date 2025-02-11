<?php

declare(strict_types=1);

namespace Movies\Domain\RecommendationAlgorithm;

final class TooFewAvailableMoviesException extends \DomainException implements AlgorithmExceptionInterface
{
    public function __construct()
    {
        parent::__construct("Too few available movies");
    }
}
<?php

declare(strict_types=1);

namespace Movies\Application\MovieSearcher;

use Movies\Domain\RecommendationAlgorithm\RecommendationAlgorithmType;

final class UnsupportedAlgorithmException extends \LogicException
{
    public function __construct(RecommendationAlgorithmType $algorithmType)
    {
        parent::__construct(sprintf(
            'Unsupported algorithm type "%s"',
            $algorithmType->name,
        ));
    }
}
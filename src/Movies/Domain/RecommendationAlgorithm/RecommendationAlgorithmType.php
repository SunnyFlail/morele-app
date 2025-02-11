<?php

declare(strict_types = 1);

namespace Movies\Domain\RecommendationAlgorithm;

enum RecommendationAlgorithmType: int
{
    case THREE_RANDOM_MOVIES = 0;
    case MOVIES_STARTING_WITH_W_AND_EVEN_NUMBER_OF_CHARACTERS = 1;
    case MOVIES_WITH_MORE_THAN_ONE_WORD = 2;

    public static function fromName(string $name): self
    {
        foreach (self::cases() as $case) {
            if ($case->name === $name) {
                return $case;
            }
        }

        throw new \InvalidArgumentException(sprintf("Unknown recommendation algorithm type %s.", $name));
    }
}

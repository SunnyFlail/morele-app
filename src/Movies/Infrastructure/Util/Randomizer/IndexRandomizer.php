<?php

declare(strict_types = 1);

namespace Movies\Infrastructure\Util\Randomizer;

use Movies\Application\Randomizer\Randomizer;
use Movies\Application\Randomizer\IndexRandomizer as IndexRandomizerInterface;

final readonly class IndexRandomizer implements IndexRandomizerInterface
{
    public function __construct(
        private Randomizer $randomizer,
    ) {
    }

    public function getUniqueRandomIndex(int $limit, array $currentIndexes): int
    {
        if ($limit <= \count($currentIndexes)) {
            throw new \OutOfBoundsException('Maximum number of unique indexes reached');
        }

        while (true) {
            $index = $this->randomizer->getRandomInteger(0, $limit - 1);

            if (false === isset($currentIndexes[$index])) {
                return $index;
            }
        }

        throw new \LogicException('Provided index exceeds boundary');
    }
}
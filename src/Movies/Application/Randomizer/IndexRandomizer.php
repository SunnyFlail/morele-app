<?php

declare(strict_types=1);

namespace Movies\Application\Randomizer;

interface IndexRandomizer
{
    /**
     * @param array<int,true> $currentIndexes
     */
    public function getUniqueRandomIndex(int $limit, array $currentIndexes): int;
}

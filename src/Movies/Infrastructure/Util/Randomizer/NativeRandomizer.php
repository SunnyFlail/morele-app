<?php

declare(strict_types = 1);

namespace Movies\Infrastructure\Util\Randomizer;

use Movies\Application\Randomizer\Randomizer;

final readonly class NativeRandomizer implements Randomizer
{
    public function getRandomInteger(int $min, int $max): int
    {
        return rand($min, $max);
    }
}
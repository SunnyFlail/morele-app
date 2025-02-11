<?php

declare(strict_types=1);

namespace Movies\Application\Randomizer;

interface Randomizer
{
    public function getRandomInteger(int $min, int $max): int;
}
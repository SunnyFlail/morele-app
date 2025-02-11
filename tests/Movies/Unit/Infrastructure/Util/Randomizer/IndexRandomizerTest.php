<?php

declare(strict_types=1);

namespace Tests\Movies\Unit\Infrastructure\Util\Randomizer;

use Movies\Application\Randomizer\Randomizer;
use Movies\Infrastructure\Util\Randomizer\IndexRandomizer;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(IndexRandomizer::class)]
final class IndexRandomizerTest extends TestCase
{
    private readonly Randomizer $randomizerMock;
    private readonly IndexRandomizer $SUT;

    protected function setUp(): void
    {
        $this->randomizerMock = $this->createMock(Randomizer::class);

        $this->SUT = new IndexRandomizer($this->randomizerMock);
    }

    public function testThrowsExceptionIfTryingToGetMoreIndexesThanLimited(): void
    {
        $currentIndexes = [1 => true];

        $this->randomizerMock
            ->expects($this->never())
            ->method('getRandomInteger');

        $this->expectException(\OutOfBoundsException::class);

        $this->SUT->getUniqueRandomIndex(1, $currentIndexes);
    }

    public function testWillReturnNewIndex(): void
    {
        $currentIndexes = [];

        $this->randomizerMock
            ->expects($this->exactly(1))
            ->method('getRandomInteger')
            ->willReturnOnConsecutiveCalls(1);

        $result = $this->SUT->getUniqueRandomIndex(1, $currentIndexes);

        $this->assertSame(1, $result);
    }

    public function testWillNotReturnAlreadyExistingIndex(): void
    {
        $currentIndexes = [1 => true];

        $this->randomizerMock
            ->expects($this->exactly(2))
            ->method('getRandomInteger')
            ->willReturnOnConsecutiveCalls(1, 2);

        $result = $this->SUT->getUniqueRandomIndex(2, $currentIndexes);

        $this->assertSame(2, $result);
    }
}

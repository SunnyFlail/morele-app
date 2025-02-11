<?php

declare(strict_types=1);

namespace Tests\Movies\Unit\Infrastructure\Util\RecommendationAlgorithm;

use Movies\Application\Provider\MovieProvider;
use Movies\Application\Randomizer\IndexRandomizer;
use Movies\Domain\Entity\Movie;
use Movies\Domain\RecommendationAlgorithm\TooFewAvailableMoviesException;
use Movies\Domain\ValueObject\MovieTitle;
use Movies\Infrastructure\Util\RecommendationAlgorithm\ThreeRandomMoviesAlgorithm;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass(ThreeRandomMoviesAlgorithm::class)]
final class ThreeRandomMoviesAlgorithmTest extends TestCase
{
    private readonly MovieProvider $movieProviderMock;
    private readonly IndexRandomizer $indexRandomizerMock;
    private readonly ThreeRandomMoviesAlgorithm $SUT;

    protected function setUp(): void
    {
        $this->movieProviderMock = $this->createMock(MovieProvider::class);
        $this->indexRandomizerMock = $this->createMock(IndexRandomizer::class);

        $this->SUT = new ThreeRandomMoviesAlgorithm(
            $this->movieProviderMock,
            $this->indexRandomizerMock,
        );
    }

    public function testThrowsExceptionIfTooFewMoviesAreAvailable(): void
    {
        $this->movieProviderMock
            ->expects($this->once())
            ->method('getMoviesCount')
            ->willReturn(2);

        $this->expectException(TooFewAvailableMoviesException::class);

        $result = $this->SUT->findMovies();
        iterator_to_array($result);
    }

    public function testFindMovies(): void
    {
        $wyspaTajemnic = new Movie(new MovieTitle('Wyspa tajemnic'));
        $laLaLand = new Movie(new MovieTitle('La La Land'));
        $lotNadKukulczymGniazdem = new Movie(new MovieTitle('Lot nad kukułczym gniazdem'));
        $movies = [
            new Movie(new MovieTitle('Gladiator')),
            new Movie(new MovieTitle('Szczęki')),
            $wyspaTajemnic,
            $laLaLand,
            new Movie(new MovieTitle('Labirynt')),
            $lotNadKukulczymGniazdem,
        ];
        $expectedResult = [
            $wyspaTajemnic,
            $laLaLand,
            $lotNadKukulczymGniazdem,
        ];

        $this->movieProviderMock
            ->expects($this->once())
            ->method('getMoviesCount')
            ->willReturn(count($movies));

        $this->movieProviderMock
            ->expects($this->once())
            ->method('getMovies')
            ->willReturn($movies);

        $this->indexRandomizerMock
            ->expects($this->exactly(3))
            ->method('getUniqueRandomIndex')
            ->willReturnOnConsecutiveCalls(3, 2, 5)
        ;

        $result = $this->SUT->findMovies();
        $result = iterator_to_array($result);

        $this->assertEqualsCanonicalizing($expectedResult, $result);
    }
}
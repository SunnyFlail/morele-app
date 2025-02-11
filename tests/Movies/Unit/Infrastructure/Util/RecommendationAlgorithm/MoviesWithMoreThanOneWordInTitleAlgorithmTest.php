<?php

declare(strict_types=1);

namespace Tests\Movies\Unit\Infrastructure\Util\RecommendationAlgorithm;

use Movies\Application\Provider\MovieProvider;
use Movies\Domain\Entity\Movie;
use Movies\Domain\ValueObject\MovieTitle;
use Movies\Infrastructure\Util\RecommendationAlgorithm\MoviesWithMoreThanOneWordInTitleAlgorithm;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass(MoviesWithMoreThanOneWordInTitleAlgorithm::class)]
final class MoviesWithMoreThanOneWordInTitleAlgorithmTest extends TestCase
{
    private readonly MovieProvider $movieProviderMock;
    private readonly MoviesWithMoreThanOneWordInTitleAlgorithm $SUT;

    protected function setUp(): void
    {
        $this->movieProviderMock = $this->createMock(MovieProvider::class);

        $this->SUT = new MoviesWithMoreThanOneWordInTitleAlgorithm(
            $this->movieProviderMock,
        );
    }

    public function testOnlyReturnsMovesStartingWithWAndEvenNumberOfCharactersAlgorithm(): void
    {
        $wyspaTajemnic = new Movie(new MovieTitle('Wyspa tajemnic'));
        $laLaLand = new Movie(new MovieTitle('La La Land'));
        $lotNadKukulczymGniazdem = new Movie(new MovieTitle('Lot nad kukułczym gniazdem'));
        $movies = [
            new Movie(new MovieTitle('Gladiator')),
            $wyspaTajemnic,
            new Movie(new MovieTitle('Szczęki')),
            $laLaLand,
            new Movie(new MovieTitle('Labirynt')),
            $lotNadKukulczymGniazdem,
        ];
        $expectedResult = [
            $lotNadKukulczymGniazdem,
            $wyspaTajemnic,
            $laLaLand,
        ];

        $this->movieProviderMock->expects($this->any())
            ->method('getMovies')
            ->willReturn($movies);

        $result = $this->SUT->findMovies();
        $result = iterator_to_array($result);

        $this->assertEqualsCanonicalizing($expectedResult, $result);
    }
}
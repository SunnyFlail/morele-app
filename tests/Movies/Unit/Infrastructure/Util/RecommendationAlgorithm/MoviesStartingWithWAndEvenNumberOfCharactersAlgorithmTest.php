<?php

declare(strict_types=1);

namespace Tests\Movies\Unit\Infrastructure\Util\RecommendationAlgorithm;

use Movies\Application\Provider\MovieProvider;
use Movies\Domain\Entity\Movie;
use Movies\Domain\ValueObject\MovieTitle;
use Movies\Infrastructure\Util\RecommendationAlgorithm\MoviesStartingWithWAndEvenNumberOfCharactersAlgorithm;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;


#[CoversClass(MoviesStartingWithWAndEvenNumberOfCharactersAlgorithm::class)]
final class MoviesStartingWithWAndEvenNumberOfCharactersAlgorithmTest extends TestCase
{
    private const array MOVIES_PASSING_TEST = [

    ];
    private const array MOVIES_FAILING_TEST = [

    ];
    private readonly MovieProvider $movieProviderMock;
    private readonly MoviesStartingWithWAndEvenNumberOfCharactersAlgorithm $SUT;

    protected function setUp(): void
    {
        $this->movieProviderMock = $this->createMock(MovieProvider::class);

        $this->SUT = new MoviesStartingWithWAndEvenNumberOfCharactersAlgorithm(
            $this->movieProviderMock,
        );
    }

    public function testOnlyReturnsMovesStartingWithWAndEvenNumberOfCharactersAlgorithm(): void
    {
        $whiplash = new Movie(new MovieTitle('Whiplash'));
        $wyspaTajemnic = new Movie(new MovieTitle('Wyspa tajemnic'));
        $laLaLand = new Movie(new MovieTitle('La La Land'));
        $movies = [
            new Movie(new MovieTitle('Człowiek z blizną')),
            new Movie(new MovieTitle('Władca Pierścieni: Powrót króla')),
            $whiplash,
            $wyspaTajemnic,
            $laLaLand,
        ];
        $expectedResult = [
            $whiplash,
            $wyspaTajemnic,
        ];

        $this->movieProviderMock->expects($this->any())
            ->method('getMovies')
            ->willReturn($movies);

        $result = $this->SUT->findMovies();
        $result = iterator_to_array($result);

        $this->assertEqualsCanonicalizing($expectedResult, $result);
    }
}
<?php

declare(strict_types=1);

namespace Tests\Movies\Application\Cli;

use Movies\Domain\RecommendationAlgorithm\RecommendationAlgorithmType;
use Movies\Infrastructure\Symfony\Console\SearchForMovies;
use PHPUnit\Framework\Attributes\CoversClass;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Tests\Movies\Application\Resource\TestMovieProvider;

#[CoversClass(SearchForMovies::class)]
final class SearchForMoviesTest extends KernelTestCase
{
    private const array WITH_MORE_THAN_ONE_WORD = [
        TestMovieProvider::WIELKI_GATSBY,
        TestMovieProvider::SZEREGOWIEC_RYAN,
        TestMovieProvider::DOKTOR_STRANGE,
        TestMovieProvider::CZLOWIEK_Z_BLIZNA,
        TestMovieProvider::CHLOPAKI_NIE_PLACZA,
        TestMovieProvider::OJCIEC_CHRZESTNY,
        TestMovieProvider::FORREST_GUMP,
        TestMovieProvider::FIGHT_CLUB,
        TestMovieProvider::WLADCA_PIERSCIENI_POWROT_KROLA,
        TestMovieProvider::LEON_ZAWODOWIEC,
        TestMovieProvider::DWUNASTU_GNIEWNYCH_LUDZI,
        TestMovieProvider::SKAZANI_NA_SHAWSHANK,
        TestMovieProvider::PULP_FICTION,
    ];
    private const array STARTING_WITH_W_AND_EVEN_CHARACTER_COUNT = [TestMovieProvider::WHIPLASH];

    public function testSearchWithThreeRandomMoviesAlgorithm(): void
    {
        $expectedCountOfNewLines = 3;
        $tester = $this->createTester();
        $tester->setInputs([RecommendationAlgorithmType::THREE_RANDOM_MOVIES->value]);

        $tester->execute([]);
        $movies = $this->getMoviesFromOutput($tester);
        $this->assertCount($expectedCountOfNewLines, $movies);
    }

    public function testSearchWithStartingWithWAndEvenCharacterCountAlgorithm(): void
    {
        $expectedCountOfNewLines = \count(self::STARTING_WITH_W_AND_EVEN_CHARACTER_COUNT);
        $tester = $this->createTester();
        $tester->setInputs([RecommendationAlgorithmType::MOVIES_STARTING_WITH_W_AND_EVEN_NUMBER_OF_CHARACTERS->value]);

        $tester->execute([]);
        $movies = $this->getMoviesFromOutput($tester);

        $this->assertCount($expectedCountOfNewLines, $movies);
        $this->assertEqualsCanonicalizing(self::STARTING_WITH_W_AND_EVEN_CHARACTER_COUNT, $movies);
        $this->assertNotContains(TestMovieProvider::WLADCA_PIERSCIENI_POWROT_KROLA, $movies);
        $this->assertNotContains(TestMovieProvider::WIELKI_GATSBY, $movies);
    }

    public function testSearchWithMoreThanOneWordAlgorithm(): void
    {
        $expectedCountOfNewLines = \count(self::WITH_MORE_THAN_ONE_WORD);
        $tester = $this->createTester();
        $tester->setInputs([RecommendationAlgorithmType::MOVIES_WITH_MORE_THAN_ONE_WORD->value]);

        $tester->execute([]);
        $movies = $this->getMoviesFromOutput($tester);

        $this->assertCount($expectedCountOfNewLines, $movies);
        $this->assertEqualsCanonicalizing(self::WITH_MORE_THAN_ONE_WORD, $movies);
    }

    private function createTester(): CommandTester
    {
        self::bootKernel();
        $application = new Application(self::$kernel);

        $command = $application->find('movies:search');

        return new CommandTester($command);
    }

    private function getMoviesFromOutput(CommandTester $tester): array
    {
        $movies = $tester->getDisplay();
        $movies = explode(SearchForMovies::MOVIES_SEPARATOR, $movies)[1];
        $movies = explode(PHP_EOL, $movies);

        return array_filter($movies);
    }
}

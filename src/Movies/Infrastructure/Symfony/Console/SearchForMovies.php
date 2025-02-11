<?php

declare(strict_types = 1);

namespace Movies\Infrastructure\Symfony\Console;

use Movies\Application\Query\FindMovieTitlesWithChosenAlgorithm\FindMovieTitlesWithChosenAlgorithmQuery;
use Movies\Domain\RecommendationAlgorithm\RecommendationAlgorithmType;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('movies:search')]
final class SearchForMovies extends Command
{
    public const string MOVIES_SEPARATOR = '--- Movies ---';
    private RecommendationAlgorithmType $algorithmType;

    public function __construct(
        private readonly FindMovieTitlesWithChosenAlgorithmQuery $query,
    ) {
        parent::__construct();
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $io = new SymfonyStyle($input, $output);

        $algorithmNames = [];

        foreach (RecommendationAlgorithmType::cases() as $algorithm) {
            $algorithmNames[$algorithm->name] = $algorithm->value;
        }

        $choice = $io->choice(
            'Choose algorithm to find movies with:',
            $algorithmNames,
        );

        $this->algorithmType = RecommendationAlgorithmType::fromName($choice);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $movies = $this->query->execute($this->algorithmType);

        $output->write(self::MOVIES_SEPARATOR);

        foreach ($movies as $movie) {
            $output->writeln($movie);
        }

        return 0;
    }
}

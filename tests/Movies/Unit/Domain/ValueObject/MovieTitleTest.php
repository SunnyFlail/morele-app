<?php

declare(strict_types=1);

namespace Tests\Movies\Unit\Domain\ValueObject;

use Movies\Domain\ValueObject\MovieTitle;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(MovieTitle::class)]
final class MovieTitleTest extends TestCase
{
    #[DataProvider('dataIsGuardedAgainstBadValue')]
    public function testIsGuardedAgainstBadValue(string $title): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new MovieTitle($title);
    }

    #[DataProvider('dataStartsWithW')]
    public function testStartsWithW(MovieTitle $title, bool $expected): void
    {
        $result = $title->startsWithW();

        $this->assertSame($expected, $result);
    }

    #[DataProvider('dataHasEvenCharacterCount')]
    public function testHasEvenCharacterCount(MovieTitle $title, bool $expected): void
    {
        $result = $title->hasEvenCharacterCount();

        $this->assertSame($expected, $result);
    }

    #[DataProvider('dataHasMoreThanOneWord')]
    public function testHasMoreThanOneWord(MovieTitle $title, bool $expected): void
    {
        $result = $title->hasMoreThanOneWord();

        $this->assertSame($expected, $result);
    }

    public static function dataIsGuardedAgainstBadValue(): iterable
    {
        yield [
            'title' => '',
        ];

        yield [
            'title' => '     ',
        ];
    }

    public static function dataStartsWithW(): iterable
    {
        yield [
            'title' => new MovieTitle('Wielkanoc'),
            'expected' => true,
        ];

        yield [
            'title' => new MovieTitle('Jak rozpętałem II wojnę światową'),
            'expected' => false,
        ];
    }

    public static function dataHasEvenCharacterCount(): iterable
    {
        yield [
            'title' => new MovieTitle('Krótki film o zabijaniu'),
            'expected' => false,
        ];

        yield [
            'title' => new MovieTitle('Rejs'),
            'expected' => true,
        ];
    }

    public static function dataHasMoreThanOneWord(): iterable
    {
        yield [
            'title' => new MovieTitle('Kariera Nikosia Dyzmy'),
            'expected' => true,
        ];

        yield [
            'title' => new MovieTitle('Killer'),
            'expected' => false,
        ];
    }
}
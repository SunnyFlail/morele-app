<?php

declare(strict_types=1);

namespace Tests\Movies\Application\Resource;

use Movies\Application\Provider\MovieProvider;
use Movies\Domain\Entity\Movie;
use Movies\Domain\ValueObject\MovieTitle;

final readonly class TestMovieProvider implements MovieProvider
{
    public const string PULP_FICTION = 'Pulp Fiction';
    public const string INCEPCJA = 'Incepcja';
    public const string SKAZANI_NA_SHAWSHANK = 'Skazani na Shawshank';
    public const string DWUNASTU_GNIEWNYCH_LUDZI = 'Dwunastu gniewnych ludzi';
    public const string OJCIEC_CHRZESTNY = 'Ojciec chrzestny';
    public const string DJANGO = 'Django';
    public const string MATRIX = 'Matrix';
    public const string LEON_ZAWODOWIEC = 'Leon zawodowiec';
    public const string SIEDEM = 'Siedem';
    public const string NIETYKALNI = 'Nietykalni';
    public const string WHIPLASH = 'Whiplash';
    public const string WLADCA_PIERSCIENI_POWROT_KROLA = 'Władca Pierścieni: Powrót króla';
    public const string FIGHT_CLUB = 'Fight Club';
    public const string FORREST_GUMP = 'Forrest Gump';
    public const string CHLOPAKI_NIE_PLACZA = 'Chłopaki nie płaczą';
    public const string GLADIATOR = 'Gladiator';
    public const string CZLOWIEK_Z_BLIZNA = 'Człowiek z blizną';
    public const string PIANISTA = 'Pianista';
    public const string DOKTOR_STRANGE = 'Doktor Strange';
    public const string SZEREGOWIEC_RYAN = 'Szeregowiec Ryan';
    public const string WIELKI_GATSBY = 'Wielki Gatsby';

    public function getMoviesCount(): int
    {
        return \iterator_count($this->getMovies());
    }

    public function getMovies(): iterable
    {
        yield new Movie(new MovieTitle(self::PULP_FICTION));
        yield new Movie(new MovieTitle(self::INCEPCJA));
        yield new Movie(new MovieTitle(self::SKAZANI_NA_SHAWSHANK));
        yield new Movie(new MovieTitle(self::DWUNASTU_GNIEWNYCH_LUDZI));
        yield new Movie(new MovieTitle(self::OJCIEC_CHRZESTNY));
        yield new Movie(new MovieTitle(self::DJANGO));
        yield new Movie(new MovieTitle(self::MATRIX));
        yield new Movie(new MovieTitle(self::LEON_ZAWODOWIEC));
        yield new Movie(new MovieTitle(self::SIEDEM));
        yield new Movie(new MovieTitle(self::NIETYKALNI));
        yield new Movie(new MovieTitle(self::WHIPLASH));
        yield new Movie(new MovieTitle(self::WLADCA_PIERSCIENI_POWROT_KROLA));
        yield new Movie(new MovieTitle(self::FIGHT_CLUB));
        yield new Movie(new MovieTitle(self::FORREST_GUMP));
        yield new Movie(new MovieTitle(self::CHLOPAKI_NIE_PLACZA));
        yield new Movie(new MovieTitle(self::GLADIATOR));
        yield new Movie(new MovieTitle(self::CZLOWIEK_Z_BLIZNA));
        yield new Movie(new MovieTitle(self::PIANISTA));
        yield new Movie(new MovieTitle(self::DOKTOR_STRANGE));
        yield new Movie(new MovieTitle(self::SZEREGOWIEC_RYAN));
        yield new Movie(new MovieTitle(self::WIELKI_GATSBY));
    }
}
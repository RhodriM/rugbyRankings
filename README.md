Rugby Rankings

php library for calculating rugby ranking points. This repo structure based vaguely on the PHP League skeleton:
https://github.com/thephpleague/skeleton

## Usage

``` php
$input = new RugbyRankings\RatingsInput(
    $teamARating,
    $teamBRating,
    $teamAScore,
    $teamBScore,
    $isNeutralVenue,
    $isRugbyWorldCup
);

$rankings = new \RugbyRankings\Main($input);

$output = $rankings->calculate();

$newTeamARating = $output->getTeamARating();
$newTeamBRating = $output->getTeamBRating();
```

For example: if Wales were to beat England 30-3 at Twickenham ;-)

``` php
$englandRating = 79.77;
$walesRating = 83.49;
$englandScore = 3;
$walesScore = 30;
$isNeutralVenue = false;
$isRugbyWorldCup = false;

$input = new RugbyRankings\RatingsInput(
    $englandRating,
    $walesRating,
    $englandScore,
    $walesScore,
    $isNeutralVenue,
    $isRugbyWorldCup
);

$rankings = new \RugbyRankings\Main($input);

$output = $rankings->calculate();

echo 'New England rating: ' . $output->getTeamARating(); // 73.38
echo "\n";
echo 'New Wales rating: ' . $output->getTeamBRating();   // 84.88
```
## Credits

- [Rhodri Morris](https://github.com/:author_username)
- [All Contributors](https://github.com/RhodriM/rugbyRankings/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

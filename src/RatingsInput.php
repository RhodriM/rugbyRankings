<?php
/**
 * RatingsInput class.
 */
namespace RugbyRankings;

/**
 * Class to hold the input we need to calculate the new ranking points.
 *
 * Basic usage, see the constructor:
 * $input = new RugbyRankings\RatingsInput(
 *     $teamARankingPoints,
 *     $teamBRankingPoints,
 *     $teamAScore,
 *     $teamBScore,
 *     $isNeutralVenue,
 *     $isRugbyWorldCup
 * );
 */
class RatingsInput
{
    /**
     * Team A Ranking points before game
     *
     * @var float
     */
    protected $teamARating;
    
    /**
     * Team B Ranking points before game
     *
     * @var float
     */
    protected $teamBRating;
    
    /**
     * Team A Score
     *
     * @var integer
     */
    protected $teamAScore;
    
    /**
     * Team B Score
     *
     * @var integer
     */
    protected $teamBScore;
    
    /**
     * Is the game at a neutral venue (no home advantage)?
     * @var boolean
     */
    protected $isNeutralVenue = false;
    
    /**
     * Is the game part of a RWC?
     * @var boolean
     */
    protected $isRugbyWorldCup = false;
    
    /**
     * Constructor takes all the params we need to calculate the new ranking
     * points.
     *
     * @param float $teamARating TeamA's ranking points before game
     * @param float $teamBRating TeamB's ranking points before game
     * @param integer $teamAScore TeamA Score in match
     * @param integer $teamBScore TeamB Score in match
     * @param boolean $isNeutralVenue is game at neutral venue?
     * @param boolean $isRugbyWorldCup is game part of RWC?
     */
    public function __construct(
        $teamARating,
        $teamBRating,
        $teamAScore,
        $teamBScore,
        $isNeutralVenue = false,
        $isRugbyWorldCup = false
    ) {
        $this->teamARating = $teamARating;
        $this->teamBRating = $teamBRating;
        $this->teamAScore = $teamAScore;
        $this->teamBScore = $teamBScore;
        $this->isNeutralVenue = $isNeutralVenue;
        $this->isRugbyWorldCup = $isRugbyWorldCup;
    }

    /**
     * Get TeamA Rating
     *
     * @return float
     */
    public function getTeamARating()
    {
        return round($this->teamARating, 2);
    }

    /**
     * Get TeamB Rating
     *
     * @return float
     */
    public function getTeamBRating()
    {
        return round($this->teamBRating, 2);
    }

    /**
     * Get Team A Score
     *
     * @return integer
     */
    public function getTeamAScore()
    {
        return (integer)$this->teamAScore;
    }

    /**
     * Get Team B Score
     *
     * @return integer
     */
    public function getTeamBScore()
    {
        return (integer)$this->teamBScore;
    }

    /**
     * Is neutral venue?
     *
     * @return boolean
     */
    public function isNeutralVenue()
    {
        return (boolean)$this->isNeutralVenue;
    }

    /**
     * Is RWC?
     *
     * @return boolean
     */
    public function isRugbyWorldCup()
    {
        return (boolean)$this->isRugbyWorldCup;
    }
}

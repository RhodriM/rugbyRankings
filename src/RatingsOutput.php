<?php
/**
 * RatingsOutput class
 */
namespace RugbyRankings;

/**
 * RatingsOutput class - simple class, just to return the new team ranking
 * points after the game.
 */
class RatingsOutput
{
    /**
     * New Team A ranking points
     *
     * @var float
     */
    protected $teamARating;

    /**
     * New Team A ranking points
     *
     * @var float
     */
    protected $teamBRating;

    /**
     * Return New Team A ranking points
     * @return float
     */
    public function getTeamARating()
    {
        return (float)$this->teamARating;
    }

    /**
     * Return New Team B ranking points
     * @return float
     */
    public function getTeamBRating()
    {
        return (float)$this->teamBRating;
    }

    /**
     * Set new team A ranking points. Rounds to 2DP.
     * @param float $teamARating
     */
    public function setTeamARating($teamARating)
    {
        $teamARating = max($teamARating, 0);
        $this->teamARating = $teamARating < 100 ? $teamARating : 100.00;
        $this->teamARating = round($this->teamARating, 2);
    }

    /**
     * Set new team B ranking points. Rounds to 2DP.
     * @param type $teamBRating
     */
    public function setTeamBRating($teamBRating)
    {
        $teamBRating = max($teamBRating, 0);
        $this->teamBRating = $teamBRating < 100 ? $teamBRating : 100.00;
        $this->teamBRating = round($this->teamBRating, 2);
    }
}

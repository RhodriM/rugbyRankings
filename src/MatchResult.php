<?php
/**
 * MatchResult class
 */
namespace RugbyRankings;

/**
 * Represents a MatchResult and holds properties such as which was the higher
 * ranked team before the match, who won etc.
 */
class MatchResult
{
    /**
     * Which team won - or drew.
     * @var string
     */
    protected $result;

    /**
     * Constants for $this->result
     */
    const TEAM_A_WIN = 'A';
    const TEAM_B_WIN = 'B';
    const DRAW = 'D';

    /**
     * Who was higher ranked before game?
     * @var string
     */
    protected $higherTeam;

    /**
     * Constants for $this->higherTeam
     */
    const HIGHER_A = 'A';
    const HIGHER_B = 'B';
    const TEAMS_EQUAL = 'E';

    /**
     * Create MatchResult
     *
     * @param float $teamAAdjustedRating
     * @param float $teamBAdjustedRating
     * @param integer $teamAScore
     * @param integer $teamBScore
     */
    public function __construct(
        $teamAAdjustedRating,
        $teamBAdjustedRating,
        $teamAScore,
        $teamBScore
    ) {
        $this->setHigherTeam($teamAAdjustedRating, $teamBAdjustedRating);
        
        $this->setResult($teamAScore, $teamBScore);
    }

    /**
     * Determines which (if either) team was higher ranked before game.
     *
     * @param float $teamARating
     * @param float $teamBRating
     * @return null
     */
    protected function setHigherTeam($teamARating, $teamBRating)
    {
        if ($teamARating == $teamBRating) {
            $this->higherTeam = self::TEAMS_EQUAL;
            return;
        }
        
        $this->higherTeam =
            ($teamARating > $teamBRating)
            ? self::HIGHER_A
            : self::HIGHER_B;
    }

    /**
     * Determines which team (if either) won.
     *
     * @param integer $teamAScore
     * @param integer $teamBScore
     * @return null
     */
    protected function setResult($teamAScore, $teamBScore)
    {
        if ($teamAScore == $teamBScore) {
            $this->result = self::DRAW;
            return;
        }
        
        $this->result =
            ($teamAScore > $teamBScore)
            ? self::TEAM_A_WIN
            : self::TEAM_B_WIN;
    }

    /**
     * Returns higher team
     *
     * @return string
     */
    public function getHigherTeam()
    {
        return $this->higherTeam;
    }

    /**
     * Returns result
     *
     * @return string
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Did the lower ranked team win? Returns false if there was no higher team.
     *
     * @return boolean
     */
    public function isUnderdogWin()
    {
        if ($this->result != self::DRAW
            && !$this->equalsWin()
            && $this->result != $this->higherTeam
        ) {
            return true;
        }
        
        return false;
    }

    /**
     * Did the higher ranked team win? Returns false if no higher team.
     *
     * @return boolean
     */
    public function isHigherTeamWin()
    {
        if ($this->result != self::DRAW
            && !$this->equalsWin()
            && $this->result == $this->higherTeam
        ) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Was there a win when the two teams were equally ranked?
     *
     * @return boolean
     */
    public function equalsWin()
    {
        if ($this->result != self::DRAW
            && $this->higherTeam == self::TEAMS_EQUAL
        ) {
            return true;
        }
        
        return false;
    }
}

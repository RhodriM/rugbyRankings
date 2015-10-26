<?php

/**
 * Calculate class
 */

namespace RugbyRankings;

/**
 * Class for calculating the new Ranking points for the teams in question.
 *
 * After construction, getOutput() will return a RatingsOutput instance
 * containing new rankings.
 */
class Calculate
{
    /**
     * The adjusted pre-match rating for team A to be used in the calculation.
     * This is after taking into account home advantage etc.
     *
     * @var float
     */
    protected $teamAPreMatchRating;
    
    /**
     * The adjusted pre-match rating for team B to be used in the calculation.
     * This is after taking into account home advantage etc.
     *
     * @var float
     */
    protected $teamBPreMatchRating;

    /**
     * The ratings Gap between the two teams (after home advantage etc
     * adjustments)
     *
     * @var float
     */
    protected $ratingsGap;

    /**
     * The RatingsOutput instance containing new ranking scores.
     *
     * @var RatingsOutput
     */
    protected $ratingsOutput;

    /**
     * Instance of Exchange for calculating the points exchange between the
     * two teams.
     *
     * @var Exchange
     */
    protected $exchange;

    /**
     * The supplied input instance.
     *
     * @var RatingsInput
     */
    protected $ratingsInput;

    /**
     * Supplied instance of MatchResult.
     *
     * @var MatchResult
     */
    protected $matchResult;

    /**
     * How many points to add to the home team's ranking points before
     * calculation.
     */
    const HOME_TEAM_ADVANTAGE = 3;

    /**
     * Maximum Ratings Gap.
     */
    const MAX_RATINGS_GAP = 10;

    /**
     * Determines adjusted pre-match rankings and sets rating gap accordingly.
     *
     * @param \RugbyRankings\RatingsInput $input
     */
    public function __construct(RatingsInput $input)
    {
        // set adjusted pre match ranking points
        $this->setPreMatchRatings(
            $input->getTeamARating(),
            $input->getTeamBRating()
        );
        
        $this->ratingsInput = $input;

        $this->worldCup = $input->isRugbyWorldCup();
        
        $this->matchResult = new MatchResult(
            $this->teamAPreMatchRating,
            $this->teamBPreMatchRating,
            $input->getTeamAScore(),
            $input->getTeamBScore()
        );

        // determine ratings gap
        $this->setRatingsGap();
    }

    /**
     * Sets adjusted pre-match ratings: home team gets self::HOME_TEAM_ADVANTAGE
     * added and both teams ratings are min/maxed at 0/100.
     *
     * @param float $teamARating
     * @param float $teamBRating
     */
    protected function setPreMatchRatings($teamARating, $teamBRating)
    {
        // ensure not below 0
        $teamARating = max($teamARating, 0);
        $teamBRating = max($teamBRating, 0);
        
        // add home team advantage - max points 100
        $this->teamAPreMatchRating =
            ($teamARating + self::HOME_TEAM_ADVANTAGE) < 100
            ? ($teamARating + self::HOME_TEAM_ADVANTAGE)
            : 100.00;
        
        // max points 100
        $this->teamBPreMatchRating
            = $teamBRating < 100 ? $teamBRating : 100.00;
    }

    /**
     * Sets rating gap: higher rating minus lower, but only up to
     * self::MAX_RATINGS_GAP
     */
    protected function setRatingsGap()
    {
        $ratingsGap =
            abs($this->teamAPreMatchRating - $this->teamBPreMatchRating);
        
        $this->ratingsGap =
            ($ratingsGap <= self::MAX_RATINGS_GAP)
            ? $ratingsGap
            : self::MAX_RATINGS_GAP;
    }

    /**
     * Get ratings gap
     *
     * @return float
     */
    public function getRatingsGap()
    {
        return $this->ratingsGap;
    }

    /**
     * Creates new Exchange instance for calculating Exchange amount; passing
     * in any relevant weightings.
     */
    protected function setExchange()
    {
        // create weightings
        $weightings = array();
        $weightings[] = new WeightingHighScore(
            $this->ratingsInput->getTeamAScore(),
            $this->ratingsInput->getTeamBScore()
        );
        
        if ($this->ratingsInput->isRugbyWorldCup()) {
            // RWC game
            $weightings[] = new WeightingWorldCup();
        }
        
        $this->exchange = new Exchange(
            $this->ratingsGap,
            $this->matchResult,
            $weightings
        );
    }

    /**
     * Calls exchange->calculate, passes back results as RatingsOutput instance.
     *
     * @return \RugbyRankings\RatingsOutput
     */
    public function getOutput()
    {
        $ratingsOutput = new RatingsOutput();
        
        $this->setExchange();
        
        $this->exchange->calculate();
        
        $ratingsOutput->setTeamARating($this->getNewTeamRating('A'));
        $ratingsOutput->setTeamBRating($this->getNewTeamRating('B'));
        
        return $ratingsOutput;
    }

    /**
     * Given a team ('A'/'B'), determines new team rating.
     *
     * @param string $team
     * @return float
     */
    protected function getNewTeamRating($team)
    {
        
        $inputRatingFunction = 'getTeam' . $team . 'Rating';
        
        if ($this->matchResult->getHigherTeam() == MatchResult::TEAMS_EQUAL) {
            // team's ranking points equal before game
            
            if ($this->matchResult->getResult() == MatchResult::DRAW) {
                // no change
                return $this->ratingsInput->$inputRatingFunction();
            }
            
            if ($this->matchResult->getResult() == $team) {
                // this team wins and gets points increase
                return $this->ratingsInput->$inputRatingFunction()
                    + $this->exchange->getExchangeAmount();
            }
            
            // team lost
            return $this->ratingsInput->$inputRatingFunction()
                - $this->exchange->getExchangeAmount();
        }
        
        if ($this->matchResult->getHigherTeam() == $team) {
            // team in question is higher ranked before game
            
            if ($this->matchResult->getResult() == $team) {
                // team won
                return $this->ratingsInput->$inputRatingFunction()
                    + $this->exchange->getExchangeAmount();
            }

            // team lost or drew, as they're higher ranked they lose points
            return $this->ratingsInput->$inputRatingFunction()
                - $this->exchange->getExchangeAmount();
        }
        
        // if we get here we're dealing with lower-ranked team before game
        if ($this->matchResult->getResult() == $team
            || $this->matchResult->getResult() == MatchResult::DRAW
        ) {
            // lower ranked team gains points from win or draw
            return $this->ratingsInput->$inputRatingFunction()
                + $this->exchange->getExchangeAmount();
        }

        // lower ranked team lost
        return $this->ratingsInput->$inputRatingFunction()
            - $this->exchange->getExchangeAmount();
    }
}

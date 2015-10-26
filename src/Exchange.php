<?php
/**
 * Exchange class.
 */
namespace RugbyRankings;

/**
 * Exchange class for calculating the points exchange between the two teams.
 */
class Exchange
{
    /**
     * Gap in ratings between teams
     *
     * @var float
     */
    protected $ratingsGap;
    
    /**
     * Points exchange
     *
     * @var float
     */
    protected $exchangeAmount;
    
    /**
     * Supplied MatchResult instance
     * @var MatchResult
     */
    protected $matchResult;

    /**
     * Array of Weighting instances, used for adjusting exchangeAmount.
     *
     * @var array
     */
    protected $weightings;

    /**
     * Following constants used for determining points exchange; for example
     * an underdog winning means a greater point exchange.
     */
    const BETTER_TEAM_WIN = 'B';
    const UNDERDOG_WIN = 'U';
    const DRAW = 'D';

    /**
     * Constructor takes 3 params: (adjusted) ratings gap between teams, a
     * MatchResult instance and an array or Weightings instances that will be
     * applied to the resulting exchange amount.
     *
     * @param float $ratingsGap adjusted ratings gap between teams
     * @param \RugbyRankings\MatchResult $matchResult MatchResult instance
     * containing info on game played.
     * @param array $weightings array of Weightings instances for adjusting
     * final exchange amount. Can be empty.
     */
    public function __construct(
        $ratingsGap,
        MatchResult $matchResult,
        array $weightings = array()
    ) {
        $this->ratingsGap = $ratingsGap;
        $this->matchResult = $matchResult;
        $this->weightings = $weightings;
    }

    /**
     * Get Final exchange amount
     *
     * @return float
     */
    public function getExchangeAmount()
    {
        return (float)$this->exchangeAmount;
    }

    /**
     * Calculates rating points exchange between teams and returns it.
     *
     * @return float the points exchange
     * @throws InvalidMatchResultException if cannot determine match result
     */
    public function calculate()
    {
        $base = ($this->ratingsGap / Calculate::MAX_RATINGS_GAP);

        if ($this->matchResult->isUnderdogWin()
            || $this->matchResult->equalsWin()
        ) {
            $this->exchangeAmount = 1 + $base;
            $this->applyWeightings();
            return $this->exchangeAmount;
        }
        
        if ($this->matchResult->isHigherTeamWin()) {
            $this->exchangeAmount = 1 - $base;
            $this->applyWeightings();
            return $this->exchangeAmount;
        }
        
        if ($this->matchResult->getResult() == MatchResult::DRAW) {
            $this->exchangeAmount = $base;
            $this->applyWeightings();
            return $this->exchangeAmount;
        }
        
        throw new InvalidMatchResultException(
            'Cannot calculate exchange: Invalid MatchResult Type'
        );
    }

    /**
     * Apply weightings to result.
     */
    protected function applyWeightings()
    {
        foreach ($this->weightings as $weighting) {
            if (! ($weighting instanceof Weighting)) {
                continue;
            }
            
            $this->exchangeAmount
                = ($this->exchangeAmount * $weighting->getMultiplier());
        }
    }
}

<?php
/**
 * Main class used as entry point to this library.
 */
namespace RugbyRankings;

/**
 * Main class and entry point. Accepts RatingsInput then creates most instances
 * needed and kicks everything off.
 *
 * To use, instantiate(pass in RatingsInput) then call calculate() to
 * get results.
 *
 */
class Main
{
    /**
     * RatingsInput passed in that holds the rankings and scores we need.
     *
     * @var RatingsInput
     */
    protected $ratingsInput;

    /**
     * Main constructor
     *
     * @param \RugbyRankings\RatingsInput $input Instance of RatingsInput
     * containing scores, pre-match ranking points, options(such as whether RWC
     * game)
     * @see RatingsInput
     */
    public function __construct(RatingsInput $input)
    {
        $this->ratingsInput = $input;
    }

    /**
     * Calculates new rankings and returns in RatingsOutput
     * @return RatingsOutput represents new rankings
     */
    public function calculate()
    {
        if ($this->ratingsInput->isNeutralVenue()) {
            $calculate = new CalculateNeutralVenue($this->ratingsInput);
            return $calculate->getOutput();
        }
        
        $calculate = new Calculate($this->ratingsInput);
        return $calculate->getOutput();
    }
}

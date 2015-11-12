<?php
/**
 * Weighting class
 */
namespace RugbyRankings;

/**
 * Base Weighting class. Weighting classes passed to Exchange to adjust final
 * exchange points amount. This base class just has a multiplier of 1, ie does
 * not affect exchange points.
 *
 */
abstract class Weighting
{
    /**
     * Multiplier to adjust exchange amount.
     *
     * @var float
     */
    protected $multiplier = 1;
    
    /**
     * Apply weighting to score and return
     *
     * @param float $points
     * @return float
     */
    public function apply($points)
    {
        return ($points * $this->multiplier);
    }
}

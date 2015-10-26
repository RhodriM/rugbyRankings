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
 * Other Weighting classes currently extend this one, and Exchange checks for
 * instance of Weighting. Possibly use interface instead in future?
 */
class Weighting
{
    /**
     * Multiplier to adjust exchange amount.
     *
     * @var float
     */
    protected $multiplier = 1;

    /**
     * Returns multiplier for adjusting exchange amount.
     * @return float
     */
    public function getMultiplier()
    {
        return $this->multiplier;
    }
}

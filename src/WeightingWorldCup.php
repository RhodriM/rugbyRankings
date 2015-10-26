<?php
/**
 * WeightingWorldCup class.
 */
namespace RugbyRankings;

/**
 * WeightingWorldCup is a simple class just to apply a different multiplier
 * for RWC games.
 */
class WeightingWorldCup extends Weighting
{
    /**
     * The RWC weighting multiplier
     *
     * @var float
     */
    protected $multiplier = 2;
}

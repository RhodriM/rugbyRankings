<?php
/**
 * CalculateNeutralVenue class: see below
 */
namespace RugbyRankings;

/**
 * This class extends Calculate and overrides setPreMatchRatings to
 * not give a home advantage.
 *
 * @see Calculate
 */
class CalculateNeutralVenue extends Calculate
{
    /**
     * Overrides Calculate's setPreMatchRatings to not give a home advantage.
     * Imposes a minimum of 0 and maximum of 100 on pre-match ratings.
     *
     * @param float $teamARating
     * @param float $teamBRating
     */
    protected function setPreMatchRatings($teamARating, $teamBRating)
    {
        // min 0
        $teamARating = max($teamARating, 0);
        $teamBRating = max($teamBRating, 0);
        
        // max 100
        $this->teamAPreMatchRating
            = $teamARating < 100 ? $teamARating : 100.00;
        $this->teamBPreMatchRating
            = $teamBRating < 100 ? $teamBRating : 100.00;
    }
}

<?php
/**
 * WeightingHighScore class
 */
namespace RugbyRankings;

/**
 * WeightingHighscore checks if team won by more than the 'HIGH_SCORE'
 * (currently 15), and if so returns adjusted multiplier.
 */
class WeightingHighScore extends Weighting
{
    /**
     * How much a team needs to win by more than to get high score multiplier
     */
    const HIGH_SCORE = 15;
    
    /**
     * The High Score Multiplier
     */
    const HIGH_SCORE_MULTIPLIER = 1.5;

    /**
     * Determines if score of match is enough to trigger High Score Multiplier,
     * and if so overrides default multiplier(1) with high score multiplier.
     *
     * @param integer $firstScore
     * @param integer $secondScore
     */
    public function __construct($firstScore, $secondScore)
    {
        if (abs($firstScore - $secondScore) > self::HIGH_SCORE) {
            $this->multiplier = self::HIGH_SCORE_MULTIPLIER;
        }
    }
}

<?php

namespace RugbyRankings\Test;

class WeightingHighScoreTest extends \PHPUnit_Framework_TestCase
{
    public function testHighScore()
    {
        $weighting = new \RugbyRankings\WeightingHighScore(10, 15);
        $this->assertEquals(1, $weighting->getMultiplier());
        
        $weighting = new \RugbyRankings\WeightingHighScore(15, 10);
        $this->assertEquals(1, $weighting->getMultiplier());
        
        $weighting = new \RugbyRankings\WeightingHighScore(0, 15);
        $this->assertEquals(1, $weighting->getMultiplier());
        
        $weighting = new \RugbyRankings\WeightingHighScore(0, 16);
        $this->assertEquals(1.5, $weighting->getMultiplier());
        
        $weighting = new \RugbyRankings\WeightingHighScore(100, 84);
        $this->assertEquals(1.5, $weighting->getMultiplier());
    }
}

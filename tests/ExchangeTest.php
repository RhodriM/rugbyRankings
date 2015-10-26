<?php

namespace RugbyRankings\Test;

class ExchangeTest extends \PHPUnit_Framework_TestCase
{

    public function testCalculate()
    {
        $matchResult = new \RugbyRankings\MatchResult(3, 0, 0, 0);
        $exc = new \RugbyRankings\Exchange(3, $matchResult);
        $this->assertEquals(0.3, $exc->calculate(), '', 0.001);
        
        $matchResult = new \RugbyRankings\MatchResult(0, 0, 0, 0);
        $exc = new \RugbyRankings\Exchange(0, $matchResult);
        $this->assertEquals(0, $exc->calculate(), '', 0.001);
        
        $matchResult = new \RugbyRankings\MatchResult(0, 0, 7, 0);
        $exc = new \RugbyRankings\Exchange(0, $matchResult);
        $this->assertEquals(1, $exc->calculate(), '', 0.001);
        
        $matchResult = new \RugbyRankings\MatchResult(3, 0, 7, 0);
        $exc = new \RugbyRankings\Exchange(3, $matchResult);
        $this->assertEquals(0.7, $exc->calculate(), '', 0.001);
    }
    
    public function testWeightingHighscore()
    {
        $highScore = new \RugbyRankings\WeightingHighScore(17, 0);
        $weightings = array($highScore);
        
        $matchResult = new \RugbyRankings\MatchResult(3, 0, 0, 0);
        $exc = new \RugbyRankings\Exchange(3, $matchResult, $weightings);
        $this->assertEquals(0.45, $exc->calculate(), '', 0.001);
        
        $matchResult = new \RugbyRankings\MatchResult(0, 0, 0, 0);
        $exc = new \RugbyRankings\Exchange(0, $matchResult, $weightings);
        $this->assertEquals(0, $exc->calculate(), '', 0.001);
        
        $matchResult = new \RugbyRankings\MatchResult(0, 0, 7, 0);
        $exc = new \RugbyRankings\Exchange(0, $matchResult, $weightings);
        $this->assertEquals(1.5, $exc->calculate(), '', 0.001);
        
        $matchResult = new \RugbyRankings\MatchResult(3, 0, 7, 0);
        $exc = new \RugbyRankings\Exchange(3, $matchResult, $weightings);
        $this->assertEquals(1.05, $exc->calculate(), '', 0.001);
    }
    
    public function testWeightingWorldCup()
    {
        $worldCup = new \RugbyRankings\WeightingWorldCup();
        $weightings = array($worldCup);
        
        $matchResult = new \RugbyRankings\MatchResult(0, 0, 0, 0);
        $exc = new \RugbyRankings\Exchange(0, $matchResult, $weightings);
        $this->assertEquals(0, $exc->calculate(), '', 0.001);
        
        $matchResult = new \RugbyRankings\MatchResult(3, 0, 0, 0);
        $exc = new \RugbyRankings\Exchange(3, $matchResult, $weightings);
        $this->assertEquals(0.6, $exc->calculate(), '', 0.001);
        
        $matchResult = new \RugbyRankings\MatchResult(0, 0, 7, 0);
        $exc = new \RugbyRankings\Exchange(0, $matchResult, $weightings);
        $this->assertEquals(2, $exc->calculate(), '', 0.001);
        
        $matchResult = new \RugbyRankings\MatchResult(3, 0, 7, 0);
        $exc = new \RugbyRankings\Exchange(3, $matchResult, $weightings);
        $this->assertEquals(1.4, $exc->calculate(), '', 0.001);
    }
    
    public function testWeightingHighscoreAndWorldCup()
    {
        $highScore = new \RugbyRankings\WeightingHighScore(17, 0);
        $worldCup = new \RugbyRankings\WeightingWorldCup();
        $weightings = array($highScore, $worldCup);
        
        $matchResult = new \RugbyRankings\MatchResult(0, 0, 0, 0);
        $exc = new \RugbyRankings\Exchange(0, $matchResult, $weightings);
        $this->assertEquals(0, $exc->calculate(), '', 0.001);
        
        $matchResult = new \RugbyRankings\MatchResult(3, 0, 0, 0);
        $exc = new \RugbyRankings\Exchange(3, $matchResult, $weightings);
        $this->assertEquals(0.9, $exc->calculate(), '', 0.001);
        
        $matchResult = new \RugbyRankings\MatchResult(0, 0, 7, 0);
        $exc = new \RugbyRankings\Exchange(0, $matchResult, $weightings);
        $this->assertEquals(3, $exc->calculate(), '', 0.001);
        
        $matchResult = new \RugbyRankings\MatchResult(3, 0, 7, 0);
        $exc = new \RugbyRankings\Exchange(3, $matchResult, $weightings);
        $this->assertEquals(2.10, $exc->calculate(), '', 0.001);
    }
    
    public function testFakeWeightings()
    {
        $weightings = array(1,2,'test','WORLDCUP');
        
        $matchResult = new \RugbyRankings\MatchResult(0, 0, 0, 0);
        $exc = new \RugbyRankings\Exchange(0, $matchResult, $weightings);
        $this->assertEquals(0, $exc->calculate(), '', 0.001);
        
        $matchResult = new \RugbyRankings\MatchResult(3, 0, 0, 0);
        $exc = new \RugbyRankings\Exchange(3, $matchResult, $weightings);
        $this->assertEquals(0.3, $exc->calculate(), '', 0.001);
        
        $matchResult = new \RugbyRankings\MatchResult(0, 0, 7, 0);
        $exc = new \RugbyRankings\Exchange(0, $matchResult, $weightings);
        $this->assertEquals(1, $exc->calculate(), '', 0.001);
        
        $matchResult = new \RugbyRankings\MatchResult(3, 0, 7, 0);
        $exc = new \RugbyRankings\Exchange(3, $matchResult, $weightings);
        $this->assertEquals(0.7, $exc->calculate(), '', 0.001);
    }
}

<?php

namespace RugbyRankings\Test;

class MatchResultTest extends \PHPUnit_Framework_TestCase
{
    public function testMatchResult()
    {
        $matchResult = new \RugbyRankings\MatchResult(0, 0, 0, 0);
        
        $this->assertEquals(
            \RugbyRankings\MatchResult::TEAMS_EQUAL,
            $matchResult->getHigherTeam()
        );
        
        $this->assertFalse($matchResult->equalsWin());
        $this->assertFalse($matchResult->isHigherTeamWin());
        $this->assertFalse($matchResult->isUnderdogWin());
        $this->assertEquals(
            \RugbyRankings\MatchResult::DRAW,
            $matchResult->getResult()
        );
        
        // ---
        
        $matchResult = new \RugbyRankings\MatchResult(3, 0, 0, 0);
        
        $this->assertEquals(
            \RugbyRankings\MatchResult::HIGHER_A,
            $matchResult->getHigherTeam()
        );
        
        $this->assertFalse($matchResult->equalsWin());
        $this->assertFalse($matchResult->isHigherTeamWin());
        $this->assertFalse($matchResult->isUnderdogWin());
        $this->assertEquals(
            \RugbyRankings\MatchResult::DRAW,
            $matchResult->getResult()
        );
        
        // ---
        
        $matchResult = new \RugbyRankings\MatchResult(0, 0, 3, 0);
        
        $this->assertEquals(
            \RugbyRankings\MatchResult::TEAMS_EQUAL,
            $matchResult->getHigherTeam()
        );
        
        $this->assertTrue($matchResult->equalsWin());
        $this->assertFalse($matchResult->isHigherTeamWin());
        $this->assertFalse($matchResult->isUnderdogWin());
        $this->assertEquals(
            \RugbyRankings\MatchResult::TEAM_A_WIN,
            $matchResult->getResult()
        );
        
        // ---
        
        $matchResult = new \RugbyRankings\MatchResult(3, 0, 3, 0);
        
        $this->assertEquals(
            \RugbyRankings\MatchResult::HIGHER_A,
            $matchResult->getHigherTeam()
        );
        
        $this->assertFalse($matchResult->equalsWin());
        $this->assertTrue($matchResult->isHigherTeamWin());
        $this->assertFalse($matchResult->isUnderdogWin());
        $this->assertEquals(
            \RugbyRankings\MatchResult::TEAM_A_WIN,
            $matchResult->getResult()
        );
        
        // ---
        
        $matchResult = new \RugbyRankings\MatchResult(3, 0, 0, 3);
        
        $this->assertEquals(
            \RugbyRankings\MatchResult::HIGHER_A,
            $matchResult->getHigherTeam()
        );
        
        $this->assertFalse($matchResult->equalsWin());
        $this->assertFalse($matchResult->isHigherTeamWin());
        $this->assertTrue($matchResult->isUnderdogWin());
        $this->assertEquals(
            \RugbyRankings\MatchResult::TEAM_B_WIN,
            $matchResult->getResult()
        );
    }
}

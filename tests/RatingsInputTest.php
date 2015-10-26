<?php

namespace RugbyRankings\Test;

class RatingsInputTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $ratings = new \RugbyRankings\RatingsInput(
            0.0,
            0.0,
            0,
            0
        );
        $this->assertInstanceOf('\RugbyRankings\RatingsInput', $ratings);
        
        $ratings = new \RugbyRankings\RatingsInput(
            0.0,
            0.0,
            0,
            0,
            true,
            true
        );
        $this->assertInstanceOf('\RugbyRankings\RatingsInput', $ratings);
    }
    
    public function testTypes()
    {
        $ratings = new \RugbyRankings\RatingsInput(
            1.111,
            90.199,
            3,
            2.2
        );
        $this->assertEquals(1.1, $ratings->getTeamARating(), '', 0.2);
        $this->assertEquals(90.20, $ratings->getTeamBRating(), '', 0.1);
        $this->assertSame(3, $ratings->getTeamAScore());
        $this->assertSame(2, $ratings->getTeamBScore());
        $this->assertSame(false, $ratings->isNeutralVenue());
        $this->assertSame(false, $ratings->isRugbyWorldCup());
        
        $ratings = new \RugbyRankings\RatingsInput(
            1.111,
            90.199,
            3,
            2.2,
            true,
            true
        );
        $this->assertSame(true, $ratings->isNeutralVenue());
        $this->assertSame(true, $ratings->isRugbyWorldCup());
    }
}

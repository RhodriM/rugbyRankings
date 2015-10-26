<?php

namespace RugbyRankings\Test;

class CalculateNeutralVenueTest extends \PHPUnit_Framework_TestCase
{
    public function testSetPreMatchRatings()
    {
        $emptyInput = new \RugbyRankings\RatingsInput(0, 0, 0, 0);
        $calc = new CalculateNeutralVenueTestClass($emptyInput);
        
        $calc->setPreMatchRatings(0, 90.3);
        $this->assertEquals(0.0, $calc->getTeamAPreMatchRating());
        $this->assertEquals(90.3, $calc->getTeamBPreMatchRating());
        
        $calc->setPreMatchRatings(-4, 101);
        $this->assertEquals(0.0, $calc->getTeamAPreMatchRating());
        $this->assertEquals(100, $calc->getTeamBPreMatchRating());
        
        $calc->setPreMatchRatings(99.9, -5);
        $this->assertEquals(99.9, $calc->getTeamAPreMatchRating());
        $this->assertEquals(0, $calc->getTeamBPreMatchRating());
    }
}

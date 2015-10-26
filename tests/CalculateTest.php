<?php

namespace RugbyRankings\Test;

class CalculateTest extends \PHPUnit_Framework_TestCase
{
    public function testSetPreMatchRatings()
    {
        $emptyInput = new \RugbyRankings\RatingsInput(0, 0, 0, 0);
        $calc = new CalculateTestClass($emptyInput);
        
        $calc->setPreMatchRatings(0, 90.3);
        $this->assertEquals(3.0, $calc->getTeamAPreMatchRating());
        $this->assertEquals(90.3, $calc->getTeamBPreMatchRating());
        
        $calc->setPreMatchRatings(-4, 101);
        $this->assertEquals(3.0, $calc->getTeamAPreMatchRating());
        $this->assertEquals(100, $calc->getTeamBPreMatchRating());
        
        $calc->setPreMatchRatings(99.9, -5);
        $this->assertEquals(100, $calc->getTeamAPreMatchRating());
        $this->assertEquals(0, $calc->getTeamBPreMatchRating());
    }

    public function testGetRatingsGap()
    {
        $emptyInput = new \RugbyRankings\RatingsInput(0, 0, 0, 0);
        $calc = new CalculateTestClass($emptyInput);
        
        $calc->setPreMatchRatings(80, 90);
        $calc->setRatingsGap();
        $this->assertEquals(7, $calc->getRatingsGap(), '', 0.1);
        
        $calc->setPreMatchRatings(40, 43);
        $calc->setRatingsGap();
        $this->assertEquals(0, $calc->getRatingsGap(), '', 0.1);
        
        $calc->setPreMatchRatings(0, 90.3);
        $calc->setRatingsGap();
        $this->assertEquals(10, $calc->getRatingsGap(), '', 0.1);
    }
    
    public function testGetOutput()
    {
        $input = new \RugbyRankings\RatingsInput(77, 80, 5, 0);
        $calc = new CalculateTestClass($input);
        
        $output = $calc->getOutput();
        $this->assertEquals(78, $output->getTeamARating());
        $this->assertEquals(79, $output->getTeamBRating());
        
        $input = new \RugbyRankings\RatingsInput(77, 80, 16, 0);
        $calc = new CalculateTestClass($input);
        
        $output = $calc->getOutput();
        $this->assertEquals(78.5, $output->getTeamARating());
        $this->assertEquals(78.5, $output->getTeamBRating());
        
        $input = new \RugbyRankings\RatingsInput(77, 80, 0, 5);
        $calc = new CalculateTestClass($input);
        
        $output = $calc->getOutput();
        $this->assertEquals(76, $output->getTeamARating());
        $this->assertEquals(81, $output->getTeamBRating());
        
        $input = new \RugbyRankings\RatingsInput(77, 80, 0, 16);
        $calc = new CalculateTestClass($input);
        
        $output = $calc->getOutput();
        $this->assertEquals(75.5, $output->getTeamARating());
        $this->assertEquals(81.5, $output->getTeamBRating());
        
        $input = new \RugbyRankings\RatingsInput(77, 80, 0, 0);
        $calc = new CalculateTestClass($input);
        
        $output = $calc->getOutput();
        $this->assertEquals(77, $output->getTeamARating());
        $this->assertEquals(80, $output->getTeamBRating());
        
        $input = new \RugbyRankings\RatingsInput(75, 80, 0, 0);
        $calc = new CalculateTestClass($input);
        
        $output = $calc->getOutput();
        $this->assertEquals(75.2, $output->getTeamARating());
        $this->assertEquals(79.8, $output->getTeamBRating());
        
        $input = new \RugbyRankings\RatingsInput(75, 80, 0, 0, false, true);
        $calc = new CalculateTestClass($input);
        
        $output = $calc->getOutput();
        $this->assertEquals(75.4, $output->getTeamARating());
        $this->assertEquals(79.6, $output->getTeamBRating());
        
        $input = new \RugbyRankings\RatingsInput(80, 80, 0, 0);
        $calc = new CalculateTestClass($input);
        
        $output = $calc->getOutput();
        $this->assertEquals(79.70, $output->getTeamARating());
        $this->assertEquals(80.30, $output->getTeamBRating());
        
        $input = new \RugbyRankings\RatingsInput(80, 80, 3, 0);
        $calc = new CalculateTestClass($input);
        
        $output = $calc->getOutput();
        $this->assertEquals(80.70, $output->getTeamARating());
        $this->assertEquals(79.30, $output->getTeamBRating());
        
        $input = new \RugbyRankings\RatingsInput(77, 80, 3, 0);
        $calc = new CalculateTestClass($input);
        
        $output = $calc->getOutput();
        $this->assertEquals(78, $output->getTeamARating());
        $this->assertEquals(79, $output->getTeamBRating());
    }
}

<?php

namespace RugbyRankings\Test;

class RatingsOutputTest extends \PHPUnit_Framework_TestCase
{
    public function testOutput()
    {
        $output = new \RugbyRankings\RatingsOutput();
        $this->assertInternalType('float', $output->getTeamARating());
        $this->assertInternalType('float', $output->getTeamBRating());
        
        $output->setTeamARating(0);
        $this->assertInternalType('float', $output->getTeamARating());
        $this->assertEquals(0.0, $output->getTeamARating(), '', 0.001);
        
        $output->setTeamBRating(100);
        $this->assertInternalType('float', $output->getTeamARating());
        $this->assertEquals(100.0, $output->getTeamBRating(), '', 0.001);
        
        $output->setTeamARating(-1);
        $this->assertInternalType('float', $output->getTeamARating());
        $this->assertEquals(0.0, $output->getTeamARating(), '', 0.001);
        
        $output->setTeamBRating(101);
        $this->assertInternalType('float', $output->getTeamARating());
        $this->assertEquals(100.0, $output->getTeamBRating(), '', 0.001);
        
        $output->setTeamBRating(9999999999999999999999999999999999999999999999);
        $this->assertInternalType('float', $output->getTeamARating());
        $this->assertEquals(100.0, $output->getTeamBRating(), '', 0.001);
        
        $output->setTeamARating(34.246563);
        $this->assertInternalType('float', $output->getTeamARating());
        $this->assertEquals(34.25, $output->getTeamARating(), '', 0.001);
        
        $output->setTeamBRating(54.2345234523452363475467457456734562456);
        $this->assertInternalType('float', $output->getTeamARating());
        $this->assertEquals(54.23, $output->getTeamBRating(), '', 0.001);
    }
}

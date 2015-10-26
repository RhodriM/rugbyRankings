<?php

namespace RugbyRankings\Test;

class MainTest extends \PHPUnit_Framework_TestCase
{
    public function testMain()
    {
        $input = new \RugbyRankings\RatingsInput(0, 0, 0, 0);
        $rankings = new \RugbyRankings\Main($input);
        $this->assertInstanceOf(
            '\RugbyRankings\RatingsOutput',
            $rankings->calculate()
        );
        
        $input = new \RugbyRankings\RatingsInput(0, 0, 0, 0, true);
        $rankings = new \RugbyRankings\Main($input);
        $this->assertInstanceOf(
            '\RugbyRankings\RatingsOutput',
            $rankings->calculate()
        );
    }
}

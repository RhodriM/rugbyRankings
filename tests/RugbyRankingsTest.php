<?php

namespace RugbyRankings\Test;

class RugbyRankingsTest extends \PHPUnit_Framework_TestCase
{

    public function testConstuct()
    {
        // test that creating with input object does not error
        $input = new \RugbyRankings\RatingsInput(0, 0, 0, 0);
        $rugby = new \RugbyRankings\Main($input);
        $this->assertInstanceOf('\RugbyRankings\Main', $rugby);
    }
}

<?php

namespace RugbyRankings\Test;

class CalculateTestClass extends \RugbyRankings\Calculate
{
    public function setPreMatchRatings($teamARating, $teamBRating)
    {
        parent::setPreMatchRatings($teamARating, $teamBRating);
    }
    
    public function getTeamAPreMatchRating()
    {
        return $this->teamAPreMatchRating;
    }

    public function getTeamBPreMatchRating()
    {
        return $this->teamBPreMatchRating;
    }
    
    public function setRatingsGap()
    {
        parent::setRatingsGap();
    }
}

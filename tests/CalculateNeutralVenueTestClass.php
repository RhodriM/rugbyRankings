<?php

namespace RugbyRankings\Test;

class CalculateNeutralVenueTestClass extends \RugbyRankings\CalculateNeutralVenue
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
}

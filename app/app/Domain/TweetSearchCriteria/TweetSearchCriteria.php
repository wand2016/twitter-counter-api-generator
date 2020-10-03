<?php

declare(strict_types=1);

namespace App\Domain\TweetSearchCriteria;

use App\Domain\TweetSearchCriteria\TweetSearchCriteria\Match;
use App\Domain\TweetSearchCriteria\TweetSearchCriteria\Period;

/**
 * Class TweetSearchCriteria
 * @package App\Domain\Tweet\TweetSearcher
 */
class TweetSearchCriteria
{
    /**
     * @var Match
     */
    private Match $match;

    /**
     * @var Period
     */
    private Period $period;

    /**
     * TweetSearchCriteria constructor.
     * @param Match $match
     * @param Period $period
     */
    public function __construct(Match $match, Period $period)
    {
        $this->match = $match;
        $this->period = $period;
    }

    /**
     * @return Match
     */
    public function getMatch(): Match
    {
        return $this->match;
    }

    /**
     * @return Period
     */
    public function getPeriod(): Period
    {
        return $this->period;
    }
}

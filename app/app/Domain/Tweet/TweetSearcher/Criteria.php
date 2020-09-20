<?php

declare(strict_types=1);

namespace App\Domain\Tweet\TweetSearcher;

use App\Domain\Tweet\TweetSearcher\Criteria\Match;
use App\Domain\Tweet\TweetSearcher\Criteria\Period;

/**
 * Class Criteria
 * @package App\Domain\Tweet\TweetSearcher
 */
class Criteria
{
    /**
     * @var Match
     */
    private Match $match;

    /**
     * @var Period
     */
    private Period $period;

    // TODO: filter

    /**
     * Criteria constructor.
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

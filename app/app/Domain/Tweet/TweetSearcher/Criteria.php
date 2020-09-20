<?php

declare(strict_types=1);

namespace App\Domain\Tweet\TweetSearcher;

use App\Domain\Tweet\TweetSearcher\Criteria\Match;

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

    // TODO: period, filter

    /**
     * Criteria constructor.
     * @param Match $match
     */
    public function __construct(Match $match)
    {
        $this->match = $match;
    }

    /**
     * @return Match
     */
    public function getMatch(): Match
    {
        return $this->match;
    }
}

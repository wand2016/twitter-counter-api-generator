<?php

declare(strict_types=1);

namespace App\Domain\TweetSearchCriteria\TweetSearchCriteria\Match;

use App\Domain\TweetSearchCriteria\TweetSearchCriteria\Match;

/**
 * Class LogicalAnd
 * @package App\Domain\TweetSearchCriteria\TweetSearchCriteria\Match
 */
class LogicalAnd implements Match
{
    /**
     * @var iterable|Match[]
     */
    private iterable $children;

    /**
     * LogicalAnd constructor.
     * @param Match ...$children
     */
    public function __construct(Match ...$children)
    {
        $this->children = $children;
    }

    /**
     * @return Match[]|iterable
     */
    public function getChildren(): iterable
    {
        return $this->children;
    }
}

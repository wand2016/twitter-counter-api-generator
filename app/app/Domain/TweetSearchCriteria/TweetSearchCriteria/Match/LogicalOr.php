<?php

declare(strict_types=1);

namespace App\Domain\TweetSearchCriteria\TweetSearchCriteria\Match;

use App\Domain\TweetSearchCriteria\TweetSearchCriteria\Match;

/**
 * Class LogicalOr
 * @package App\Domain\TweetSearchCriteria\TweetSearchCriteria
 */
class LogicalOr implements Match
{
    /**
     * @var iterable|Match[]
     */
    private iterable $children;

    /**
     * LogicalOr constructor.
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

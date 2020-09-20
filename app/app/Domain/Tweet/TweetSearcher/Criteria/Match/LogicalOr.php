<?php

declare(strict_types=1);

namespace App\Domain\Tweet\TweetSearcher\Criteria\Match;

use App\Domain\Tweet\TweetSearcher\Criteria\Match;

/**
 * Class LogicalOr
 * @package App\Domain\Tweet\TweetSearcher\Criteria
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

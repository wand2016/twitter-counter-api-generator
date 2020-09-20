<?php

declare(strict_types=1);

namespace App\Domain\Tweet\TweetSearcher\Criteria\Match;

use App\Domain\Tweet\TweetSearcher\Criteria\Match;

/**
 * Class LogicalAnd
 * @package App\Domain\Tweet\TweetSearcher\Criteria\Match
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

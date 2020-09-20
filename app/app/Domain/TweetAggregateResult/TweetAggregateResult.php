<?php

declare(strict_types=1);

namespace App\Domain\TweetAggregateResult;

use App\Domain\TweetAggregateResult\TweetAggregateResult\Daily;

/**
 * Class TweetAggregateResult
 * @package App\Domain\TweetAggregateResult
 */
class TweetAggregateResult
{
    /**
     * @var iterable|Daily[]
     */
    private iterable $dailyCounts;

    /**
     * TweetAggregateResult constructor.
     * @param Daily ...$dailyCounts
     */
    public function __construct(Daily ...$dailyCounts)
    {
        $this->dailyCounts = $dailyCounts;
    }

    /**
     * @return Daily[]|iterable
     */
    public function getDailyCounts(): iterable
    {
        return $this->dailyCounts;
    }

    // TODO: derivatives
}

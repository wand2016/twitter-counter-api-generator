<?php

declare(strict_type=1);

namespace App\Domain\Tweet;

use App\Domain\Tweet\AggregateResult\Daily;

/**
 * Class AggregateResult
 * @package App\Domain\Tweet
 */
class AggregateResult
{
    /**
     * @var iterable|Daily[]
     */
    private iterable $dailyCounts;

    /**
     * AggregateResult constructor.
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

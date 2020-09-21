<?php

declare(strict_types=1);

namespace App\Domain\TweetAggregateResult;

use App\Domain\Tweet\Tweet;
use App\Domain\Tweet\TweetSearchResult;
use App\Domain\TweetAggregateResult\TweetAggregateResult\Daily;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

/**
 * Class TweetAggregateResult
 * @package App\Domain\TweetAggregateResult
 */
class TweetAggregateResult
{
    /**
     * @var Daily[]
     */
    private array $dailyAggregateResultMap = [];

    /**
     * TweetAggregateResult constructor.
     * @param Daily ...$dailyAggregateResults
     */
    public function __construct(Daily ...$dailyAggregateResults)
    {
        foreach ($dailyAggregateResults as $dailyAggregateResult) {
            $this->putDailyAggregateResult($dailyAggregateResult);
        }
    }

    /**
     * @return iterable|Daily[]
     */
    public function getDailyAggregateResults(): iterable
    {
        return collect($this->dailyAggregateResultMap)
            ->values();
    }

    /**
     * @param TweetSearchResult $tweetSearchResult
     */
    public function applySearchResult(TweetSearchResult $tweetSearchResult): void
    {
        collect($tweetSearchResult->getTweets())
            ->groupBy(
                function (Tweet $tweet): int {
                    return CarbonImmutable::instance($tweet->getTweetedAt())
                        ->startOfDay()
                        ->getTimestamp();
                }
            )
            ->each(
                function (Collection $group, int $timestamp): void {
                    $this->putDailyAggregateResult(
                        new Daily(
                            new Daily\Date(CarbonImmutable::createFromTimestamp($timestamp)),
                            $group->count()
                        )
                    );
                }
            );
    }

    /**
     * @param Daily $dailyAggregateResult
     */
    public function putDailyAggregateResult(Daily $dailyAggregateResult): void
    {
        $this->dailyAggregateResultMap[$dailyAggregateResult->getDate()->getTimestamp()] = $dailyAggregateResult;
    }
}

<?php

declare(strict_types=1);

namespace App\Domain\TweetAggregateResult;

use App\Domain\Tweet\Tweet;
use App\Domain\Tweet\TweetSearchResult;
use App\Domain\TweetAggregateResult\TweetAggregateResult\Daily;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

/**
 * Class TweetAggregateResult
 * @package App\Domain\TweetAggregateResult
 */
final class TweetAggregateResult
{
    /**
     * @var EndpointName
     */
    private EndpointName $endpointName;

    /**
     * @var Daily[]
     */
    private array $dailyAggregateResultMap = [];

    /**
     * TweetAggregateResult constructor.
     * @param EndpointName $endpointName
     */
    private function __construct(EndpointName $endpointName)
    {
        $this->endpointName = $endpointName;
    }

    /**
     * @return EndpointName
     */
    public function getEndpointName(): EndpointName
    {
        return $this->endpointName;
    }

    /**
     * @return iterable|Daily[]
     */
    public function getDailyAggregateResults(): iterable
    {
        return collect($this->dailyAggregateResultMap)
            ->values()
            ->sort(
                function (Daily $left, Daily $right): int {
                    return $left->getDate()->getTimestamp()
                        - $right->getDate()->getTimestamp();
                }
            )
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
                        ->timezone(config()->get('app.timezone'))
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

    /**
     * @param EndpointName $endpointName
     * @param iterable|Daily[] $dailyAggregateResults
     * @return static
     */
    public static function create(
        EndpointName $endpointName,
        iterable $dailyAggregateResults = []
    ): self {
        $ret = new static($endpointName);

        foreach ($dailyAggregateResults as $dailyAggregateResult) {
            $ret->putDailyAggregateResult($dailyAggregateResult);
        }

        return $ret;
    }
}

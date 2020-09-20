<?php

declare(strict_type=1);

namespace App\Domain\Tweet;

use App\Domain\Tweet\AggregateResult\Daily;
use App\Domain\Tweet\Date\Date;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

/**
 * Class TweetAggregator
 * @package App\Domain\Tweet
 */
class TweetAggregator
{
    /**
     * @param TweetCollection $tweetCollection
     * @return AggregateResult
     */
    public function aggregate(TweetCollection $tweetCollection): AggregateResult
    {
        $dailyResults = collect($tweetCollection->getTweets())
            ->groupBy(
                function (Tweet $tweet): int {
                    return CarbonImmutable::instance($tweet->getTweetedAt())
                        ->startOfDay()
                        ->getTimestamp();
                }
            )
            ->map(
                function (Collection $group, int $timestamp): Daily {
                    return new Daily(
                        new Date(
                            CarbonImmutable::createFromTimestamp($timestamp)->startOfDay()
                        ),
                        $group->count()
                    );
                }
            );

        return new AggregateResult(...$dailyResults);
    }
}

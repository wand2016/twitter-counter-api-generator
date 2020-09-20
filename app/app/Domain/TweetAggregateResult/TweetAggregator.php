<?php

declare(strict_types=1);

namespace App\Domain\TweetAggregateResult;

use App\Domain\Tweet\Tweet;
use App\Domain\Tweet\Tweet\Date;
use App\Domain\Tweet\TweetCollection;
use App\Domain\TweetAggregateResult\TweetAggregateResult\Daily;
use Carbon\CarbonImmutable;
use Illuminate\Support\Collection;

/**
 * Class TweetAggregator
 * @package App\Domain\TweetAggregateResult
 */
class TweetAggregator
{
    /**
     * @param TweetCollection $tweetCollection
     * @return TweetAggregateResult
     */
    public function aggregate(TweetCollection $tweetCollection): TweetAggregateResult
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

        return new TweetAggregateResult(...$dailyResults);
    }
}

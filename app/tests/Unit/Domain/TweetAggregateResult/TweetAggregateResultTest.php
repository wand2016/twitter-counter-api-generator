<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\TweetAggregateResult;

use App\Domain\Tweet\Tweet;
use App\Domain\Tweet\TweetSearchResult;
use App\Domain\TweetAggregateResult\TweetAggregateResult;
use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use Carbon\CarbonImmutable;
use Tests\TestCase;

class TweetAggregateResultTest extends TestCase
{
    public function testApplySearchResultEmpty(): void
    {
        $sut = TweetAggregateResult::create(new EndpointName('syaroshico'));

        $this->assertEmpty(
            $sut->getDailyAggregateResults()
        );
    }

    public function testApplySearchResultApplied(): void
    {
        $sut = TweetAggregateResult::create(new EndpointName('syaroshico'));

        $tweetSearchResult = new TweetSearchResult(
            $this->createTweetAt(2020, 10, 1, 0, 0, 0),
            $this->createTweetAt(2020, 10, 1, 12, 34, 56),
            $this->createTweetAt(2020, 10, 2, 0, 0, 0),
        );

        $sut->applySearchResult($tweetSearchResult);
        $dailyAggregateResults = [...$sut->getDailyAggregateResults()];

        $this->assertCount(
            2,
            $dailyAggregateResults
        );
        $this->assertDailyResult(
            TweetAggregateResult\Daily\Date::create(2020, 10, 1),
            2,
            $dailyAggregateResults[0]
        );
        $this->assertDailyResult(
            TweetAggregateResult\Daily\Date::create(2020, 10, 2),
            1,
            $dailyAggregateResults[1]
        );
    }

    public function testApplySearchResultOverwritten(): void
    {
        $sut = TweetAggregateResult::create(
            new EndpointName('syaroshico'),
            [
                new TweetAggregateResult\Daily(TweetAggregateResult\Daily\Date::create(2020, 10, 1), 2),
                new TweetAggregateResult\Daily(TweetAggregateResult\Daily\Date::create(2020, 10, 2), 1),
            ]
        );

        $tweetSearchResult = new TweetSearchResult(
            $this->createTweetAt(2020, 10, 1, 0, 0, 0),
            // some tweets has been deleted
            $this->createTweetAt(2020, 10, 2, 0, 0, 0),
            $this->createTweetAt(2020, 10, 3, 23, 59, 59),
        );

        $sut->applySearchResult($tweetSearchResult);
        $dailyAggregateResults = [...$sut->getDailyAggregateResults()];

        $this->assertCount(
            3,
            $sut->getDailyAggregateResults()
        );
        $this->assertDailyResult(
            TweetAggregateResult\Daily\Date::create(2020, 10, 1),
            1,
            $dailyAggregateResults[0]
        );
        $this->assertDailyResult(
            TweetAggregateResult\Daily\Date::create(2020, 10, 2),
            1,
            $dailyAggregateResults[1]
        );
        $this->assertDailyResult(
            TweetAggregateResult\Daily\Date::create(2020, 10, 3),
            1,
            $dailyAggregateResults[2]
        );
    }

    /**
     * @param int $year
     * @param int $month
     * @param int $day
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @return Tweet
     */
    private function createTweetAt(
        int $year,
        int $month,
        int $day,
        int $hour,
        int $minute,
        int $second
    ): Tweet {
        $datetime = CarbonImmutable::create($year, $month, $day, $hour, $minute, $second);
        assert($datetime !== false);
        return Tweet::create($datetime);
    }

    /**
     * @param TweetAggregateResult\Daily\Date $dateExpected
     * @param int $countExpected
     * @param TweetAggregateResult\Daily $aDailyResult
     */
    private function assertDailyResult(
        TweetAggregateResult\Daily\Date $dateExpected,
        int $countExpected,
        TweetAggregateResult\Daily $aDailyResult
    ): void {
        $this->assertEquals(
            $dateExpected,
            $aDailyResult->getDate()
        );
        $this->assertSame(
            $countExpected,
            $aDailyResult->getCount()
        );
    }
}

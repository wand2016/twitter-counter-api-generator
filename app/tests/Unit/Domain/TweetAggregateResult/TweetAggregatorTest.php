<?php

namespace Tests\Unit\Domain\TweetAggregateResult;

use App\Domain\Tweet\Tweet;
use App\Domain\Tweet\Tweet\Date;
use App\Domain\Tweet\TweetCollection;
use App\Domain\TweetAggregateResult\TweetAggregateResult\Daily;
use App\Domain\TweetAggregateResult\TweetAggregator;
use Carbon\CarbonImmutable;
use PHPUnit\Framework\TestCase;

class TweetAggregatorTest extends TestCase
{
    /**
     * @var TweetAggregator
     */
    private TweetAggregator $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new TweetAggregator();
    }

    public function testAggregateEmpty(): void
    {
        $tweetCollection = new TweetCollection();

        $aggregateResult = $this->sut->aggregate($tweetCollection);

        $this->assertEmpty(
            $aggregateResult->getDailyCounts()
        );
    }

    public function testAggregate(): void
    {
        $tweetCollection = new TweetCollection(
            $this->createTweetAt(2020, 10, 1, 0, 0, 0),
            $this->createTweetAt(2020, 10, 1, 12, 34, 56),
            $this->createTweetAt(2020, 10, 2, 0, 0, 0),
        );

        $aggregateResult = $this->sut->aggregate($tweetCollection);
        $dailyCounts = [...$aggregateResult->getDailyCounts()];

        $this->assertCount(
            2,
            $dailyCounts,
            '# of groups'
        );

        $this->assertDailyResult(
            Date::create(2020, 10, 1),
            2,
            $dailyCounts[0]
        );
        $this->assertDailyResult(
            Date::create(2020, 10, 2),
            1,
            $dailyCounts[1]
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
        assert($datetime);
        return Tweet::create($datetime);
    }

    /**
     * @param Date $dateExpected
     * @param int $countExpected
     * @param Daily $aDailyResult
     */
    private function assertDailyResult(
        Date $dateExpected,
        int $countExpected,
        Daily $aDailyResult
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

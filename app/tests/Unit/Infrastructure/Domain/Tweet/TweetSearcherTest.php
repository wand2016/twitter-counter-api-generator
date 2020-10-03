<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Domain\Tweet;

use App\Domain\TweetSearchCriteria\TweetSearchCriteria;
use App\Domain\TweetSearchCriteria\TweetSearchCriteria\Match\Keyword;
use App\Domain\TweetSearchCriteria\TweetSearchCriteria\Match\LogicalAnd;
use App\Domain\TweetSearchCriteria\TweetSearchCriteria\Match\NotRetweet;
use App\Domain\TweetSearchCriteria\TweetSearchCriteria\Period;
use App\Infrastructure\Domain\Tweet\TweetSearcher as TweetSearcherImpl;
use Carbon\CarbonImmutable;
use Tests\TestCase;

class TweetSearcherTest extends TestCase
{
    /**
     * @var TweetSearcherImpl
     */
    private TweetSearcherImpl $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = $this->app->make(TweetSearcherImpl::class);
    }

    public function testSearch(): void
    {
        $this->markTestSkipped('external API call');

        $today = CarbonImmutable::today();

        $criteria = new TweetSearchCriteria(
            new LogicalAnd(
                new Keyword('ごちうさ'),
                new NotRetweet()
            ),
            Period::since(
                $today->year,
                $today->month,
                $today->day - 1
            ),
        );

        $tweetCollection = $this->sut->search($criteria);

        $this->assertGreaterThan(
            100,
            $tweetCollection->count()
        );
    }
}

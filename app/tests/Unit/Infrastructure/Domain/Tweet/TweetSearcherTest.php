<?php

namespace Tests\Unit\Infrastructure\Domain\Tweet;

use App\Domain\Tweet\TweetSearcher;
use App\Infrastructure\Domain\Tweet\TweetSearcher as TweetSearcherImpl;
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
        $criteria = new TweetSearcher\Criteria(
            new TweetSearcher\Criteria\Match\Keyword('ごちうさ'),
            TweetSearcher\Criteria\Period::since(2020, 9, 20)
        );

        $tweetCollection = $this->sut->search($criteria);

        var_dump($tweetCollection->count());
    }
}

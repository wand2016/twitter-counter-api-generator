<?php

declare(strict_types=1);

namespace Tests\Unit\Infrastructure\Domain\TweetAggregateResult;

use App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi\EndpointName;
use App\Infrastructure\Domain\TweetAggregateResult\TweetAggregateResultRepository;
use Tests\TestCase;

class TweetAggregateResultRepositoryTest extends TestCase
{
    /**
     * @var TweetAggregateResultRepository
     */
    private TweetAggregateResultRepository $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = $this->app->make(TweetAggregateResultRepository::class);
    }

    public function testFindById(): void
    {
        $tweetAggregateResult = $this->sut->findByEndpointName(new EndpointName('hoge'));
    }

    public function testPersist(): void
    {
    }
}

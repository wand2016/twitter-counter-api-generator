<?php

namespace Tests\Unit\Infrastructure\Gateway\Twitter\v2;

use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDto;
use Tests\TestCase;

class SearchRecentTweetsGatewayTest extends TestCase
{
    /**
     * @var SearchRecentTweetsGateway
     */
    private SearchRecentTweetsGateway $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = $this->app->make(SearchRecentTweetsGateway::class);
    }

    public function testCall(): void
    {
        $this->markTestSkipped('external api call');

        $requestDto = new SearchRecentTweetsGateway\Dto\RequestDto(
            'ごちうさ',
            null,
            null,
            [new RequestDto\TweetField\CreatedAt()],
            new RequestDto\MaxResults(100),
            null
        );

        $responseDto = $this->sut->call($requestDto);

        $this->assertTrue(true);
    }
}

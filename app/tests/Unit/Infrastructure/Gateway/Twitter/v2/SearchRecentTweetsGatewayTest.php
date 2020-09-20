<?php

namespace Tests\Unit\Infrastructure\Gateway\Twitter\v2;

use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\RequestDto;
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
        $request = new SearchRecentTweetsGateway\RequestDto(
            'ごちうさ',
            null,
            null,
            [new RequestDto\TweetField\CreatedAt()],
            new RequestDto\MaxResults(100),
            null
        );

        $response = $this->sut->call($request);

        var_export($response->getRaw());

        $this->assertTrue(true);
    }
}

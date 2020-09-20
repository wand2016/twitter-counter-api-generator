<?php

namespace Tests\Unit\Infrastructure\Gateway\Twitter\v2;

use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway;
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
        $request = new SearchRecentTweetsGateway\RequestDto('#しこにっき', null, null, null);

        $response = $this->sut->call($request);

        var_export($response->getRaw());

        $this->assertTrue(true);
    }
}

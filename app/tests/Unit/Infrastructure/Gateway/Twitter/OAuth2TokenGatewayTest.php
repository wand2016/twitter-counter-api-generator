<?php

namespace Tests\Unit\Infrastructure\Gateway\Twitter;

use App\Infrastructure\Gateway\Twitter\OAuth2TokenGateway;
use Tests\TestCase;

class OAuth2TokenGatewayTest extends TestCase
{
    /**
     * @var OAuth2TokenGateway
     */
    private OAuth2TokenGateway $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = $this->app->make(OAuth2TokenGateway::class);
    }

    public function testGenerateBearerToken(): void
    {
        $consumerKey = config()->get('twitter.credentials.consumerKey');
        $consumerSecret = config()->get('twitter.credentials.consumerSecret');

        $bearerToken = $this->sut->generateBearerToken($consumerKey, $consumerSecret);

        $this->assertStringStartsWith(
            'AAAA',
            $bearerToken
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2;

use App\Infrastructure\Gateway\Twitter\OAuth2TokenGateway;

/**
 * Class BearerTokenPool
 * @package App\Infrastructure\Gateway\Twitter\v2
 */
class BearerTokenPool
{
    /**
     * @var string|null
     */
    private ?string $bearerToken = null;

    /**
     * @var OAuth2TokenGateway
     */
    private OAuth2TokenGateway $oAuth2TokenGateway;

    /**
     * @var string
     */
    private string $consumerKey;

    /**
     * @var string
     */
    private string $consumerSecret;

    /**
     * BearerTokenPool constructor.
     * @param OAuth2TokenGateway $oAuth2TokenGateway
     * @param string $consumerKey
     * @param string $consumerSecret
     */
    public function __construct(
        OAuth2TokenGateway $oAuth2TokenGateway,
        string $consumerKey,
        string $consumerSecret
    ) {
        $this->oAuth2TokenGateway = $oAuth2TokenGateway;
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
    }


    /**
     * @return string
     * @throws \App\Exceptions\TwitterApi\AuthorizationFailedException
     * @throws \App\Exceptions\TwitterApi\AuthorizationTokenParseFailedException
     */
    public function getBearerToken(): string
    {
        if ($this->bearerToken) {
            return $this->bearerToken;
        }

        $this->bearerToken = $this->oAuth2TokenGateway->generateBearerToken($this->consumerKey, $this->consumerSecret);
        return $this->bearerToken;
    }
}

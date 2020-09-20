<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter;

use GuzzleHttp\Client;

/**
 * Class OAuth2TokenGateway
 * @package App\Infrastructure\Gateway\Twitter
 */
class OAuth2TokenGateway
{
    /**
     * {@see http://docs.guzzlephp.org/en/stable/request-options.html#body}
     */
    private const URI = 'https://api.twitter.com/oauth2/token';

    /**
     * @var Client
     */
    private Client $client;

    /**
     * OAuth2TokenGateway constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    /**
     * @param string $consumerKey
     * @param string $consumerSecretKey
     * @return string
     * TODO: specify exception
     */
    public function generateBearerToken(
        string $consumerKey,
        string $consumerSecretKey
    ): string {
        $bearerTokenCredentials = base64_encode("{$consumerKey}:{$consumerSecretKey}");

        $response = $this->client->post(
            static::URI,
            [
                'headers' => [
                    'Authorization' => "Basic {$bearerTokenCredentials}",
                    'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8',
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials',
                ],
            ]
        );

        return $this->parseAccessToken($response->getBody()->getContents());
    }

    /**
     * @param string $responseContents
     *        example: "{"token_type":"bearer","access_token":"xxx..."}"
     * @return string
     */
    private function parseAccessToken(string $responseContents): string
    {
        return \json_decode($responseContents)->access_token;
    }
}

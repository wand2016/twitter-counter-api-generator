<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter;

use App\Exceptions\TwitterApi\AuthorizationFailedException;
use App\Exceptions\TwitterApi\AuthorizationTokenParseFailedException;
use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;

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
     * @var ClientInterface
     */
    private ClientInterface $client;

    /**
     * OAuth2TokenGateway constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $consumerKey
     * @param string $consumerSecretKey
     * @return string
     * @throws AuthorizationFailedException
     * @throws AuthorizationTokenParseFailedException
     */
    public function generateBearerToken(
        string $consumerKey,
        string $consumerSecretKey
    ): string {
        $bearerTokenCredentials = base64_encode("{$consumerKey}:{$consumerSecretKey}");

        try {
            $response = $this->client->request(
                'post',
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
        } catch (GuzzleException $e) {
            throw AuthorizationFailedException::createFromGuzzleException($e);
        }

        return $this->parseAccessToken($response->getBody()->getContents());
    }

    /**
     * @param string $responseContents
     *        example: "{"token_type":"bearer","access_token":"xxx..."}"
     * @return string
     * @throws AuthorizationTokenParseFailedException
     */
    private function parseAccessToken(string $responseContents): string
    {
        try {
            return \json_decode($responseContents)->access_token;
        } catch (Exception $e) {
            throw new AuthorizationTokenParseFailedException($responseContents, 0, $e);
        }
    }
}

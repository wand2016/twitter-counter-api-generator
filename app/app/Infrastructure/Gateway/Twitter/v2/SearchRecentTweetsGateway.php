<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2;

use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\RequestDto;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\ResponseDto;
use GuzzleHttp\Client;

/**
 * Class SearchRecentTweetsGateway
 * @package App\Infrastructure\Gateway\Twitter\v2
 */
class SearchRecentTweetsGateway
{
    /**
     * {@see https://developer.twitter.com/en/docs/twitter-api/tweets/search/api-reference/get-tweets-search-recent}
     */
    private const URI = 'https://api.twitter.com/2/tweets/search/recent';

    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var BearerTokenPool
     */
    private BearerTokenPool $bearerTokenPool;

    /**
     * SearchRecentTweetsGateway constructor.
     * @param Client $client
     * @param BearerTokenPool $bearerTokenPool
     */
    public function __construct(Client $client, BearerTokenPool $bearerTokenPool)
    {
        $this->client = $client;
        $this->bearerTokenPool = $bearerTokenPool;
    }


    /**
     * @param RequestDto $request
     * @return ResponseDto
     * TODO: specify throws
     */
    public function call(RequestDto $request): ResponseDto
    {
        $bearerToken = $this->bearerTokenPool->getBearerToken();

        $response = $this->client->get(
            static::URI,
            [
                'query' => [
                    'query' => $request->toQueryString(),
                ],
                'headers' => [
                    'Authorization' => "Bearer ${bearerToken}",
                ],
            ]
        );

        return ResponseDto::createFromResponseContents($response->getBody()->getContents());
    }
}

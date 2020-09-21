<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2;

use App\Exceptions\TwitterApi\SearchRecentFailedException;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDto;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\ResponseDto;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\ResponseDtoFactory;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;

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
     * @var ResponseDtoFactory
     */
    private ResponseDtoFactory $responseDtoFactory;

    /**
     * SearchRecentTweetsGateway constructor.
     * @param Client $client
     * @param BearerTokenPool $bearerTokenPool
     * @param ResponseDtoFactory $responseDtoFactory
     */
    public function __construct(
        Client $client,
        BearerTokenPool $bearerTokenPool,
        ResponseDtoFactory $responseDtoFactory
    ) {
        $this->client = $client;
        $this->bearerTokenPool = $bearerTokenPool;
        $this->responseDtoFactory = $responseDtoFactory;
    }


    /**
     * @param RequestDto $request
     * @return ResponseDto
     * @throws SearchRecentFailedException
     * @throws \App\Exceptions\TwitterApi\AuthorizationFailedException
     * @throws \App\Exceptions\TwitterApi\AuthorizationTokenParseFailedException
     * @throws \App\Exceptions\TwitterApi\SearchRecentResponseParseFailedException
     */
    public function call(RequestDto $request): ResponseDto
    {
        $bearerToken = $this->bearerTokenPool->getBearerToken();
        try {
            $response = $this->client->get(
                static::URI,
                [
                    'query' => $request->toQueryParameters(),
                    'headers' => [
                        'Authorization' => "Bearer ${bearerToken}",
                    ],
                ]
            );
        } catch (BadResponseException $e) {
            throw new SearchRecentFailedException($e);
        }

        return $this->responseDtoFactory->parsePsrResponseContents($response);
    }
}

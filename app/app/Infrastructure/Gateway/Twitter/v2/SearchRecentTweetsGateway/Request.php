<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway;

use DateTimeInterface;

/**
 * Class Request
 * @package App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway
 * {@see https://developer.twitter.com/en/docs/twitter-api/tweets/search/api-reference/get-tweets-search-recent}
 */
class Request
{
    /**
     * @var string
     */
    private string $query;

    /**
     * @var DateTimeInterface|null
     */
    private ?DateTimeInterface $startTime;

    /**
     * @var DateTimeInterface|null
     */
    private ?DateTimeInterface $endTime;

    /**
     * for fetching over 100 tweets
     * @var string|null
     */
    private ?string $sinceId;

    /**
     * Request constructor.
     * @param string $query
     * @param DateTimeInterface|null $startTime
     * @param DateTimeInterface|null $endTime
     * @param string|null $sinceId
     */
    public function __construct(
        string $query,
        ?DateTimeInterface $startTime,
        ?DateTimeInterface $endTime,
        ?string $sinceId
    ) {
        $this->query = $query;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->sinceId = $sinceId;
    }

    /**
     * @return string
     */
    public function toQueryString(): string
    {
        // TODO: impl
        return '';
    }
}

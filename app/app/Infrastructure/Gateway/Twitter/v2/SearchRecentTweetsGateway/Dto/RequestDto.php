<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto;

use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\Common\Token;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDto\MaxResults;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDto\TweetField;
use Carbon\CarbonImmutable;
use DateTimeInterface;

/**
 * Class RequestDto
 * @package App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto
 * {@see https://developer.twitter.com/en/docs/twitter-api/tweets/search/api-reference/get-tweets-search-recent}
 */
final class RequestDto
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
     * @var iterable|TweetField[]
     */
    private iterable $tweetFields;

    /**
     * @var MaxResults|null
     */
    private ?MaxResults $maxResults;

    /**
     * for fetching over 100 tweets
     * @var Token|null
     */
    private ?Token $nextToken;

    /**
     * RequestDto constructor.
     * @param string $query
     * @param DateTimeInterface|null $startTime
     * @param DateTimeInterface|null $endTime
     * @param TweetField[]|iterable $tweetFields
     * @param MaxResults|null $maxResults
     * @param Token|null $nextToken
     */
    public function __construct(
        string $query,
        ?DateTimeInterface $startTime,
        ?DateTimeInterface $endTime,
        iterable $tweetFields,
        ?MaxResults $maxResults,
        ?Token $nextToken = null
    ) {
        $this->query = $query;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->tweetFields = $tweetFields;
        $this->maxResults = $maxResults;
        $this->nextToken = $nextToken;
    }


    /**
     * @return array
     */
    public function toQueryParameters(): array
    {
        return array_filter(
            [
                'query' => $this->query,
                'start_time' => $this->startTimeOrNull(),
                'end_time' => $this->endTimeOrNull(),
                'tweet.fields' => $this->tweetFieldsOrNull(),
                'max_results' => $this->maxResultsOrNull(),
                'next_token' => $this->nextTokenOrNull(),
            ],
            function ($val): bool {
                return $val !== null;
            }
        );
    }

    /**
     * @return string|null
     */
    private function startTimeOrNull(): ?string
    {
        return $this->startTime ? CarbonImmutable::instance($this->startTime)->toIso8601String() : null;
    }

    /**
     * @return string|null
     */
    private function endTimeOrNull(): ?string
    {
        return $this->endTime ? CarbonImmutable::instance($this->endTime)->toIso8601String() : null;
    }

    /**
     * @return string|null
     */
    private function tweetFieldsOrNull(): ?string
    {
        $ret = collect($this->tweetFields)
            ->map(
                function (TweetField $tweetField): string {
                    return $tweetField->getValue();
                }
            )
            ->join(',');

        return $ret === '' ? null : $ret;
    }

    /**
     * @return int|null
     */
    private function maxResultsOrNull(): ?int
    {
        return $this->maxResults ? $this->maxResults->getValue() : null;
    }

    /**
     * @return string|null
     */
    private function nextTokenOrNull(): ?string
    {
        return $this->nextToken ? $this->nextToken->getValue() : null;
    }
}

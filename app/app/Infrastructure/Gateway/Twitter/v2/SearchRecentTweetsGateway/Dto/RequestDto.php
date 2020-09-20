<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto;

use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\Common\Token;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDto\MaxResults;
use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\Dto\RequestDto\TweetField;
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
     * TODO: impl
     * @return array
     */
    public function toQueryParameters(): array
    {
        $ret = [
            'query' => $this->query,
        ];

        $tweetFields = $this->buildTweetFields();
        if ($tweetFields) {
            $ret['tweet.fields'] = $tweetFields;
        }

        $maxResults = $this->buildMaxResults();
        if ($maxResults) {
            $ret['max_results'] = $maxResults;
        }

        $nextToken = $this->buildNextToken();
        if ($nextToken) {
            $ret['next_token'] = $nextToken;
        }

        return $ret;
    }

    /**
     * @return string
     */
    private function buildTweetFields(): string
    {
        return collect($this->tweetFields)
            ->map(
                function (TweetField $tweetField): string {
                    return $tweetField->getValue();
                }
            )
            ->join(',');
    }

    /**
     * @return int|null
     */
    private function buildMaxResults(): ?int
    {
        return $this->maxResults ? $this->maxResults->getValue() : null;
    }

    /**
     * @return string|null
     */
    private function buildNextToken(): ?string
    {
        return $this->nextToken ? $this->nextToken->getValue() : null;
    }
}

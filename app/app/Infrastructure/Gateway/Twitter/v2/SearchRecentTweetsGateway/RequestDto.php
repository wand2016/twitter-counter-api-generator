<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway;

use App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\RequestDto\TweetField;
use DateTimeInterface;

/**
 * Class Request
 * @package App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway
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
     * for fetching over 100 tweets
     * @var string|null
     */
    private ?string $sinceId;

    /**
     * RequestDto constructor.
     * @param string $query
     * @param DateTimeInterface|null $startTime
     * @param DateTimeInterface|null $endTime
     * @param TweetField[]|iterable $tweetFields
     * @param string|null $sinceId
     */
    public function __construct(
        string $query,
        ?DateTimeInterface $startTime,
        ?DateTimeInterface $endTime,
        iterable $tweetFields,
        ?string $sinceId = null
    ) {
        $this->query = $query;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->tweetFields = $tweetFields;
        $this->sinceId = $sinceId;
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
}

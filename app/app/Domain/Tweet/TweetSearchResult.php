<?php

declare(strict_types=1);

namespace App\Domain\Tweet;

/**
 * Class TweetSearchResult
 * @package App\Domain\Tweet
 */
class TweetSearchResult
{
    /**
     * @var Tweet[]
     */
    private array $tweets;

    /**
     * TweetSearchResult constructor.
     * @param Tweet ...$tweets
     */
    public function __construct(Tweet ...$tweets)
    {
        $this->tweets = $tweets;
    }

    /**
     * @return Tweet[]
     */
    public function getTweets(): array
    {
        return $this->tweets;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->tweets);
    }
}

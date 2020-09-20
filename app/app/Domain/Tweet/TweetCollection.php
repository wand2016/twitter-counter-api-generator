<?php

declare(strict_type=1);

namespace App\Domain\Tweet;

/**
 * Class TweetCollection
 * @package App\Domain\Tweet
 */
class TweetCollection
{
    /**
     * @var iterable|Tweet[]
     */
    private iterable $tweets;

    /**
     * TweetCollection constructor.
     * @param Tweet ...$tweets
     */
    public function __construct(Tweet ...$tweets)
    {
        $this->tweets = $tweets;
    }

    /**
     * @return Tweet[]|iterable
     */
    public function getTweets(): iterable
    {
        return $this->tweets;
    }
}

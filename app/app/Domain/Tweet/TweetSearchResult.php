<?php

declare(strict_types=1);

namespace App\Domain\Tweet;

use App\Domain\TweetSearchCriteria\TweetSearchCriteria;

/**
 * Class TweetSearchResult
 * @package App\Domain\Tweet
 */
class TweetSearchResult
{
    /**
     * @var TweetSearchCriteria
     */
    private TweetSearchCriteria $criteria;

    /**
     * @var Tweet[]
     */
    private array $tweets;

    /**
     * TweetSearchResult constructor.
     * @param TweetSearchCriteria $criteria
     * @param Tweet ...$tweets
     */
    public function __construct(
        TweetSearchCriteria $criteria,
        Tweet ...$tweets
    ) {
        $this->criteria = $criteria;
        $this->tweets = $tweets;
    }

    /**
     * @return TweetSearchCriteria
     */
    public function getCriteria(): TweetSearchCriteria
    {
        return $this->criteria;
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

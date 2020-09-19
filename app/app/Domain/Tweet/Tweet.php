<?php

declare(strict_type=1);

namespace App\Domain\Tweet;

use DatetimeInterface;

/**
 * Class Tweet
 * @package App\Domain\Tweet
 */
final class Tweet
{
    /**
     * @var DatetimeInterface
     */
    private DatetimeInterface $tweetedAt;

    /**
     * Tweet constructor.
     * @param DatetimeInterface $tweetedAt
     */
    private function __construct(DatetimeInterface $tweetedAt)
    {
        $this->tweetedAt = $tweetedAt;
    }

    /**
     * @param DatetimeInterface $tweetedAt
     * @return static
     */
    public static function create(DatetimeInterface $tweetedAt): self
    {
        return new static($tweetedAt);
    }
}

<?php

declare(strict_types=1);

namespace App\Domain\Tweet;

use DatetimeInterface;

/**
 * Class Tweet
 * @package App\Domain\Tweet
 */
final class Tweet
{
    /**
     * @var string
     */
    private string $text;

    /**
     * @var DatetimeInterface
     */
    private DatetimeInterface $tweetedAt;

    /**
     * Tweet constructor.
     * @param string $text
     * @param DatetimeInterface $tweetedAt
     */
    public function __construct(string $text, DatetimeInterface $tweetedAt)
    {
        $this->text = $text;
        $this->tweetedAt = $tweetedAt;
    }


    /**
     * @param string $text
     * @param DatetimeInterface $tweetedAt
     * @return static
     */
    public static function create(
        string $text,
        DatetimeInterface $tweetedAt
    ): self {
        return new static(
            $text,
            $tweetedAt
        );
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return DatetimeInterface
     */
    public function getTweetedAt(): DatetimeInterface
    {
        return $this->tweetedAt;
    }
}

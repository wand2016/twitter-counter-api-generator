<?php

declare(strict_types=1);

namespace App\Domain\TweetSearchCriteria\TweetSearchCriteria\Match;

use App\Domain\TweetSearchCriteria\TweetSearchCriteria\Match;

/**
 * who tweets
 * Class Account
 * @package App\Domain\TweetSearchCriteria\TweetSearchCriteria\Match
 */
class Account implements Match
{
    /**
     * @var string
     */
    private string $value;

    /**
     * Account constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}

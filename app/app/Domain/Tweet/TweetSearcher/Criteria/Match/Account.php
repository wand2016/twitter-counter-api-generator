<?php

declare(strict_type=1);

namespace App\Domain\Tweet\TweetSearcher\Criteria\Match;

use App\Domain\Tweet\TweetSearcher\Criteria\Match;

/**
 * who tweets
 * Class Account
 * @package App\Domain\Tweet\TweetSearcher\Criteria\Match
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

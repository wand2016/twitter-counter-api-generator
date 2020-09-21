<?php

declare(strict_types=1);

namespace App\Domain\Tweet\TweetSearcher\Criteria\Match;

use App\Domain\Tweet\TweetSearcher\Criteria\Match;

/**
 * tweets what
 * Class Keyword
 * @package App\Domain\Tweet\TweetSearcher\Criteria\Match
 */
class Keyword implements Match
{
    /**
     * @var string
     */
    private string $value;

    /**
     * Keyword constructor.
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

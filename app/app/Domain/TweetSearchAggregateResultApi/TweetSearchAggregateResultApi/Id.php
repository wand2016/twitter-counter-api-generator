<?php

declare(strict_types=1);

namespace App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi;

use Ramsey\Uuid\Uuid;

/**
 * Class Id
 * @package App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi
 */
final class Id
{
    /**
     * @var string
     */
    private string $value;

    /**
     * Id constructor.
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

    /**
     * @return static
     */
    public static function generate(): self
    {
        return new static(Uuid::uuid4()->toString());
    }
}

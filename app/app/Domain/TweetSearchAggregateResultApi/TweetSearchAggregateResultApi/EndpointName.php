<?php

declare(strict_types=1);

namespace App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi;

/**
 * Class EndpointName
 * @package App\Domain\TweetSearchAggregateResultApi\TweetSearchAggregateResultApi
 */
final class EndpointName
{
    /**
     * @var string
     */
    private string $value;

    /**
     * EndpointName constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        // TOOD: validation
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

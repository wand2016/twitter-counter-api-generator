<?php

declare(strict_types=1);

namespace App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\RequestDto;

use DomainException;

/**
 * Class MaxResults
 * @package App\Infrastructure\Gateway\Twitter\v2\SearchRecentTweetsGateway\RequestDto
 */
final class MaxResults
{
    private const MIN = 10;

    private const MAX = 100;

    /**
     * invariant: between MIN and MAX
     * @var int
     */
    private int $value;

    /**
     * MaxResults constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        if ($value < static::MIN || static::MAX < $value) {
            throw new DomainException(sprintf('max_results must be between %d and %d.', static::MIN, static::MAX));
        }

        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return static
     */
    public static function max(): self
    {
        return new static(static::MAX);
    }
}

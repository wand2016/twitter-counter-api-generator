<?php

declare(strict_types=1);

namespace App\Domain\TweetAggregateResult\TweetAggregateResult\Daily;

use Carbon\CarbonImmutable;
use DateTimeInterface;
use InvalidArgumentException;

/**
 * Class Date
 * @package App\Domain\TweetAggregateResult\TweetAggregateResult\Daily
 */
final class Date
{
    /**
     * invariant: start of day
     * @var CarbonImmutable
     */
    private CarbonImmutable $carbon;

    /**
     * Date constructor.
     * @param DateTimeInterface $date
     */
    public function __construct(DateTimeInterface $date)
    {
        $carbon = CarbonImmutable::instance($date);

        if (!$carbon->isStartOfDay()) {
            throw new InvalidArgumentException('specified datetime is not start of day.');
        }

        $this->carbon = $carbon;
    }

    /**
     * @return string
     */
    public function toIso8601String(): string
    {
        return $this->carbon->toIso8601String();
    }

    /**
     * @param int $year
     * @param int $month
     * @param int $day
     * @return static
     */
    public static function create(int $year, int $month, int $day): self
    {
        $carbon = CarbonImmutable::create($year, $month, $day, 0, 0, 0);

        if (!$carbon) {
            throw new InvalidArgumentException();
        }

        return new static($carbon);
    }
}

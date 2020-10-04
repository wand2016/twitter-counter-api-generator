<?php

declare(strict_types=1);

namespace App\Domain\TweetSearchCriteria\TweetSearchCriteria;

use Carbon\CarbonImmutable;
use DateTimeInterface;
use InvalidArgumentException;

/**
 * Class Period
 * @package App\Domain\TweetSearchCriteria\TweetSearchCriteria
 */
final class Period
{
    /**
     * @var DateTimeInterface
     */
    private DateTimeInterface $startDate;

    /**
     * @var DateTimeInterface
     */
    private DateTimeInterface $endDate;

    /**
     * Period constructor.
     * @param DateTimeInterface $startDate
     * @param DateTimeInterface $endDate
     */
    private function __construct(
        DateTimeInterface $startDate,
        DateTimeInterface $endDate
    ) {
        if (!CarbonImmutable::instance($startDate)->isStartOfDay()) {
            throw new InvalidArgumentException('startDate must be start of day.');
        }

        if (!CarbonImmutable::instance($endDate)->isStartOfDay()) {
            throw new InvalidArgumentException('endDate must be start of day.');
        }

        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return DateTimeInterface
     */
    public function getStartDate(): DateTimeInterface
    {
        return $this->startDate;
    }

    /**
     * @return DateTimeInterface
     */
    public function getEndDate(): DateTimeInterface
    {
        return $this->endDate;
    }

    /**
     * @return iterable|DateTimeInterface[]
     */
    public function days(): iterable
    {
        $itr = CarbonImmutable::instance($this->startDate);
        $until = CarbonImmutable::instance($this->endDate);

        while ($itr->lessThanOrEqualTo($until)) {
            yield $itr;
            $itr = $itr->addDay();
        }
    }

    /**
     * @param int $startYear
     * @param int $startMonth
     * @param int $startDay
     * @param int $endYear
     * @param int $endMonth
     * @param int $endDay
     * @return static
     */
    public static function create(
        int $startYear,
        int $startMonth,
        int $startDay,
        int $endYear,
        int $endMonth,
        int $endDay
    ): self {
        $startDate = static::makeStartDate($startYear, $startMonth, $startDay);
        $endDate = static::makeEndDate($endYear, $endMonth, $endDay);

        return new static(
            $startDate,
            $endDate
        );
    }

    /**
     * @param int $startYear
     * @param int $startMonth
     * @param int $startDay
     * @return CarbonImmutable
     */
    private static function makeStartDate(int $startYear, int $startMonth, int $startDay): CarbonImmutable
    {
        $startDate = CarbonImmutable::create($startYear, $startMonth, $startDay, 0, 0, 0);
        assert($startDate !== false);
        return $startDate;
    }

    /**
     * @param int $endYear
     * @param int $endMonth
     * @param int $endDay
     * @return CarbonImmutable
     */
    private static function makeEndDate(int $endYear, int $endMonth, int $endDay): CarbonImmutable
    {
        $endDate = CarbonImmutable::create($endYear, $endMonth, $endDay, 0, 0, 0);
        assert($endDate !== false);
        return $endDate;
    }
}

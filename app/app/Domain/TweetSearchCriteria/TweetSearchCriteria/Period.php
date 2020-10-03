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
     * @var DateTimeInterface|null
     */
    private ?DateTimeInterface $startDate;

    /**
     * @var DateTimeInterface|null
     */
    private ?DateTimeInterface $endDate;

    /**
     * Period constructor.
     * @param DateTimeInterface|null $startDate
     * @param DateTimeInterface|null $endDate
     */
    private function __construct(
        ?DateTimeInterface $startDate,
        ?DateTimeInterface $endDate
    ) {
        if ($startDate && !CarbonImmutable::instance($startDate)->isStartOfDay()) {
            throw new InvalidArgumentException('startDate must be start of day.');
        }

        if ($endDate && !CarbonImmutable::instance($endDate)->isStartOfDay()) {
            throw new InvalidArgumentException('endDate must be start of day.');
        }

        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getEndDate()
    {
        return $this->endDate;
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
     * @return static
     */
    public static function since(
        int $startYear,
        int $startMonth,
        int $startDay
    ): self {
        return new static(
            static::makeStartDate($startYear, $startMonth, $startDay),
            null
        );
    }

    /**
     * @param int $endYear
     * @param int $endMonth
     * @param int $endDay
     * @return static
     */
    public static function until(
        int $endYear,
        int $endMonth,
        int $endDay
    ): self {
        return new static(
            null,
            static::makeEndDate($endYear, $endMonth, $endDay)
        );
    }

    /**
     * @return static
     */
    public static function unbound(): self
    {
        return new static(null, null);
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

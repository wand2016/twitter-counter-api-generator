<?php

declare(strict_types=1);

namespace App\Domain\Tweet\TweetSearcher\Criteria;

use Carbon\CarbonImmutable;
use InvalidArgumentException;

/**
 * Class Period
 * @package App\Domain\Tweet\TweetSearcher\Criteria
 */
final class Period
{
    /**
     * @var CarbonImmutable
     */
    private CarbonImmutable $startDate;

    /**
     * @var CarbonImmutable
     */
    private CarbonImmutable $endDate;

    /**
     * Period constructor.
     * @param CarbonImmutable $startDate
     * @param CarbonImmutable $endDate
     */
    public function __construct(CarbonImmutable $startDate, CarbonImmutable $endDate)
    {
        if (!$startDate->isStartOfDay()) {
            throw new InvalidArgumentException('startDate must be start of day.');
        }

        if (!$endDate->isStartOfDay()) {
            throw new InvalidArgumentException('endDate must be start of day.');
        }

        $this->startDate = $startDate;
        $this->endDate = $endDate;
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
            CarbonImmutable::maxValue()
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
            CarbonImmutable::minValue(),
            static::makeEndDate($endYear, $endMonth, $endDay)
        );
    }

    /**
     * @return static
     */
    public static function unbound(): self
    {
        return new static(CarbonImmutable::minValue(), CarbonImmutable::maxValue());
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
